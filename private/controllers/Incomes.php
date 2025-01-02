<?php

/**
 * Incomes controller
 */
class Incomes extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        $data = [];
        $errors = array();
        $incomes = new Income();
        $rowtype = new Incomtype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($incomes->validate($_POST)) {
                $incomes->insert($_POST);

                $_SESSION['messsage'] = "Income Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("incomes");
            } else {
                $errors = $incomes->errors;
            }
        }

        $rowstype = $rowtype->findAll();

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `incomes` WHERE `date` =:search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => $_GET['search_list'],
            ];

            $data = $incomes->findSearch($query, $arr);
        } else {
            $data = $incomes->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "date";
        return $this->view('incomes', [
            'errors' => $errors,
            'rows' => $data,
            'rowstype' => $rowstype,
            'pager' => $pager,
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
        $incomes = new Income();
        $rowtype = new Incomtype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($incomes->validate($_POST)) {
                $incomes->update($id, $_POST);

                $_SESSION['messsage'] = "Income Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("incomes");
            } else {
                $errors = $incomes->errors;
            }
        }

        $data = $incomes->where('id', $id)[0];
        $rowstype = $rowtype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('incomes.edit', [
            'errors' => $errors,
            'row' => $data,
            'rowstype' => $rowstype,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function ptaedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $ptafees = new Ptafee();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            $ptafees->update($id, $_POST);

            $_SESSION['messsage'] = "PTA Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("incomes/pta");
        }

        $data = $ptafees->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('incomes.ptaedit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function pta()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $studentses = [];
        $errors = array();
        $ptafees = new Ptafee();
        $students = new Student();
        $classes = new Classe();

        $dataclass = $classes->findAll();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            $_POST['semesterid'] =  $_SESSION['semester']->id;

            if (isset($_POST['export'])) {
                $query = "SELECT ptafees.* FROM `ptafees` WHERE ptafees.`semesterid` =:semesterid";

                $arr = [
                    'semesterid' => $_SESSION['semester']->id,
                ];

                $exportdata = $ptafees->findSearch($query, $arr);

                if ($exportdata) {
                    $fields = array('Sudent No#', 'First Name', 'Last Name', 'Class', 'Reciept', 'Reciept', 'Amount', 'Date');
                    $excelData = implode("\t", array_values($fields)) . "\n";

                    if ($exportdata) {
                        foreach ($exportdata as $row) {
                            $lineData = array(
                                $row->studentid,
                                $row->student->first_name,
                                $row->student->last_name,
                                $row->student->class->classname,
                                $row->recieptnum,
                                $row->amount,
                                date('d/m/Y', strtotime($row->date))
                            );
                            $excelData .= implode("\t", array_values($lineData)) . "\n";
                        }

                        $_SESSION['messsage'] = "PTA Payment Expoted Successfully";
                        $_SESSION['status_code'] = "success";
                        $_SESSION['status_headen'] = "Good job!";

                        export_data_to_excel($fields, $excelData, 'PTA_Fees_List');
                    } else {
                        $excelData .= 'No records found...' . "\n";
                    }
                }
            } else
            if ($ptafees->validate($_POST)) {

                $ptafees->insert($_POST);

                $_SESSION['messsage'] = "PTA Payment Made Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("/incomes/pta");
            } else {
                $errors = $ptafees->errors;
            }
        }

        if (isset($_GET['search_class'])) {
            $studentses = $students->where_query("SELECT * FROM `students` WHERE `activenes` = 0 AND `classid` =:classids", $arr = [
                'classids' =>  $_GET['search_class'],
            ]);
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT ptafees.* FROM `ptafees` LEFT JOIN students ON ptafees.semesterid =students.studentid WHERE ptafees.`semesterid` =:semesterid AND ptafees.`studentid` LIKE :search_list OR `recieptnum` LIKE :search_list OR students.first_name LIKE :search_list OR students.last_name LIKE :search_list LIMIT $limit OFFSET $offset";

            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
                'semesterid' => $_SESSION['semester']->id,
            ];

            $data = $ptafees->findSearch($query, $arr);
        } else {
            $data = $ptafees->where('semesterid',  $_SESSION['semester']->id, $limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "yeap";
        return $this->view('incomes.pta', [
            'errors' => $errors,
            'rows' => $data,
            'rowclas' => $dataclass,
            'studentses' => $studentses,
            'crumbs' => $crumbs,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
