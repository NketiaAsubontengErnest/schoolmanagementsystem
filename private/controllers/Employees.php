<?php

/**
 * Employees controller
 */
class Employees extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        $employees = new Employee();
        $users = new User();        

        if (isset($_POST['export'])) {
            $exportdata = $employees->findAll();

            if ($exportdata) {
                $fields = array('Staff No#', 'First Name', 'Last Name', 'Gender', 'Address', 'Date of Birth', 'Nationality', 'NHIS',  'National ID', 'Job Title', 'Basic Salary', 'Weekly Allow.', 'SSNIT Amount', 'Food Stipend', 'Employment Type');
                $excelData = implode("\t", array_values($fields)) . "\n";

                if ($exportdata) {
                    foreach ($exportdata as $row) {
                        if ($row->activenes == 0) {
                            $lineData = array(
                                $row->staffid,
                                $row->first_name,
                                $row->last_name,
                                $row->gender,
                                $row->address,
                                date('d/m/Y', strtotime($row->date_of_birth)),
                                $row->nationality,
                                $row->health_ins_id,
                                $row->gh_id,
                                get_Staff_Posi($row->job_titil),
                                $row->basic_salary,
                                $row->weeklyallowance,
                                $row->ssnitamount,
                                $row->foodalloance,
                                $row->status,
                            );
                        }
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }
                    export_data_to_excel($fields, $excelData, 'Employees_List');
                } else {
                    $excelData .= 'No records found...' . "\n";
                }
            }elseif (isset($_POST['deactive'])) {
                $employees->query("UPDATE `employees` SET `activenes`='1' WHERE `staffid` =:deactive", $_POST);
    
                $_SESSION['messsage'] = "Employee De-Activated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                $employees->query("UPDATE `employees` SET `activenes`='0' WHERE `staffid` =:active", $_POST);
    
                $_SESSION['messsage'] = "Employee Activated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }

            $_SESSION['messsage'] = "Employees Data Exported Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }

        if (isset($_POST['user'])) {
            $usee = $employees->where('id', $_POST['user'])[0];

            $employees->query("UPDATE `employees` SET `adduser`='1' WHERE `staffid` =:staffid", ['staffid' => $usee->staffid]);
            $arr = [
                'staffid' => $usee->staffid,
                'password' => $usee->staffid,
                'rank' => $usee->job_titil,
            ];
            $users->insert($arr);
        }

        if (isset($_POST['unuser'])) {
            $usee = $employees->where('id', $_POST['unuser'])[0];

            $employees->query("UPDATE `employees` SET `adduser`='0' WHERE `staffid` =:staffid", ['staffid' => $usee->staffid]);
            $users->query("DELETE FROM `users` WHERE `staffid` =:staffid", ['staffid' => $usee->staffid]);
        }
        if (isset($_POST['reset'])) {;
            $arr = [
                'pass' => password_hash($_POST['reset'], PASSWORD_DEFAULT),
                'staffid' => $_POST['reset']
            ];
            $users->query("UPDATE `users` SET `password`=:pass WHERE `staffid` =:staffid", $arr);

            $_SESSION['messsage'] = "Password Reset Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
        }
        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `employees` WHERE `staffid` LIKE :search_list OR `first_name` LIKE :search_list OR `last_name` LIKE :search_list OR `phone` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
            ];

            $data = $employees->findSearch($query, $arr);
        } else {
            $data = $employees->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'employ';
        $hiddenSearch = "yeap";
        return $this->view('employees', [
            'errors' => $errors,
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $employees = new Employee();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($employees->validate($_POST)) {
                $employees->insert($_POST);

                $_SESSION['messsage'] = "Employees Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("employees");
            } else {
                $errors = $employees->errors;
            }
        }

        $data = $employees->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'employ';
        $hiddenSearch = "no";
        return $this->view('employees.add', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function assignclass($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $employees = new Employee();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            $employees->update($id, $_POST);

            $_SESSION['messsage'] = "Employee Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("employees");
        }

        $data = $employees->where('id', $id)[0];
        $dataclass = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'employ';
        $hiddenSearch = "no";
        return $this->view('employees.assignclass', [
            'errors' => $errors,
            'row' => $data,
            'dataclass' => $dataclass,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function edit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $employees = new Employee();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            $employees->update($id, $_POST);

            $_SESSION['messsage'] = "Employee Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("employees");
        }

        $data = $employees->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'employ';
        $hiddenSearch = "no";
        return $this->view('employees.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
