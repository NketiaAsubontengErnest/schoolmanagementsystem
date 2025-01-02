<?php

/**
 * Matrons controller
 */
class Matrons extends Controller
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
        $students = new Student();

        $data = $students->query('SELECT * FROM `students` WHERE `credit` != 0 AND students.activenes = 0');
        $data = $students->get_Class_Type($data);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'credit';
        $hiddenSearch = "yeap";
        return $this->view('credits', [
            'errors' => $errors,
            'rows' => $data,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function feedingarrears()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $feeddata = [];
        $errors = array();
        $students = new Student();
        $classes = new Classe();
        $feedsarreas = new Feedingarrea();

        $dataclass = $classes->findAll();

             
        if (count($_POST) > 0 && Auth::access('matron')) {
            if (isset($_POST['export'])) {
                $data = $feedsarreas->where('status',1,$limit, $offset);
    
                if ($data) {
                    $fields = array('Date', 'Student No.', 'Student Name', 'Class', 'Amount (GHC)');
                    $excelData = implode("\t", array_values($fields)) . "\n";
    
                    if ($data) {
                        foreach ($data as $row) {
                            $lineData = array(
                                $row->date,
                                $row->studentnum,
                                esc($row->student->first_name).' '.esc($row->student->last_name),
                                $row->student->class->classname,
                                esc(number_format($row->amount, 2))
                            );
                            $excelData .= implode("\t", array_values($lineData)) . "\n";
                        }
    
                        export_data_to_excel($fields, $excelData, 'Matron_Arreas_Report');
                    } else {
                        $excelData .= 'No records found...' . "\n";
                    }
                }
                return $this->redirect("/matrons/feedingarrears");
            }else
            if (isset($_POST['cleararres'])) {
                $_POST['status'] = 2;
                $id = $_POST['cleararres'];
                unset($_POST['cleararres']);
                $feedsarreas->update($id, $_POST);

                $_SESSION['messsage'] = "Arrears Cleared Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else 
            if (isset($_POST['deletearres'])) {
                $feedsarreas->delete($_POST['deletearres']);

                $_SESSION['messsage'] = "Arrears Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                if ($feedsarreas->validate($_POST)) {
                    $_POST['status'] = 1;
                    $_POST['classid'] = $_GET['search_class'];
                    $feedsarreas->insert($_POST);

                    $_SESSION['messsage'] = "Arrears Added Successfully";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_headen'] = "Good job!";
                }
            }
            return $this->redirect("/matrons/feedingarrears");
        }

        if (isset($_GET['search_class'])) {
            $data = $students->where_query("SELECT * FROM `students` WHERE `activenes` = 0 AND `classid` =:classids", $arr = [
                'classids' =>  $_GET['search_class'],
            ]);
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT feedingarreas.* FROM `feedingarreas` LEFT JOIN students ON feedingarreas.studentnum = students.studentid WHERE (`status` = 1) AND students.first_name LIKE :search_list OR students.last_name LIKE :search_list OR students.studentid LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
            ];

            $feeddata = $feedsarreas->findSearch($query, $arr);
        } else {
            $feeddata = $feedsarreas->where('status',1,$limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'credit';
        $hiddenSearch = "yeap";
        return $this->view('matrons.feedingarrears', [
            'errors' => $errors,
            'rows' => $data,
            'rowclas' => $dataclass,
            'rowsfeeds' => $feeddata,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function payedarrears()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;
        
        $feeddata = [];
        $errors = array();
        $feedsarreas = new Feedingarrea();

        if (count($_POST) > 0 && Auth::access('matron')) {
            if (isset($_POST['cleararres'])) {
                $_POST['status'] = 1;
                $id = $_POST['cleararres'];
                unset($_POST['cleararres']);
                $feedsarreas->update($id, $_POST);

                $_SESSION['messsage'] = "Arrears Un-Cleared Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else 
            if (isset($_POST['deletearres'])) {
                $feedsarreas->delete($_POST['deletearres']);

                $_SESSION['messsage'] = "Arrears Deleted Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } 
            return $this->redirect("/matrons/payedarrears");
        }

        
        if (isset($_GET['search_list'])) {
            $query = "SELECT feedingarreas.* FROM `feedingarreas` LEFT JOIN students ON feedingarreas.studentnum = students.studentid WHERE (`status` = 1) AND students.first_name LIKE :search_list OR students.last_name LIKE :search_list OR students.studentid LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list' => '%' . $_GET['search_list'] . '%',
            ];

            $feeddata = $feedsarreas->findSearch($query, $arr);
        } else {
            $feeddata = $feedsarreas->where('status',2,$limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'credit';
        $hiddenSearch = "yeap";
        return $this->view('matrons.payedarrears', [
            'errors' => $errors,
            'rows' => $feeddata,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function expentypes()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronexpendtype();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $matrontype->insert($_POST);

            $_SESSION['messsage'] = "Type Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/expentypes");
        }

        $data = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.expentypes', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function incomes()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $datatype = [];
        $errors = array();
        $matrontype = new Matronincometype();
        $incomes = new Matronincome();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $incomes->insert($_POST);

            $_SESSION['messsage'] = "Income Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/incomes");
        }

        $data = $incomes->where('semesterid', $_SESSION['semester']->id, $limit, $offset, 'DESC');
        $datatype = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.incomes', [
            'errors' => $errors,
            'rows' => $data,
            'rowstype' => $datatype,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function expenses()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        // Setting pagination
        $limit = 20;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $datatype = [];
        $errors = array();
        $matrontype = new Matronexpendtype();
        $expends = new Matronexpend();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $expends->insert($_POST);

            $_SESSION['messsage'] = "Expenditure Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/expenses");
        }

        $data = $expends->where('semesterid', $_SESSION['semester']->id, $limit, $offset, 'DESC');
        $datatype = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.expenses', [
            'errors' => $errors,
            'rows' => $data,
            'rowstype' => $datatype,
            'pager' => $pager,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function incomtypes()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronincometype();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $matrontype->insert($_POST);

            $_SESSION['messsage'] = "Type Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/incomtypes");
        }

        $data = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.incomtypes', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function incomtypesedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronincometype();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $matrontype->update($id, $_POST);

            $_SESSION['messsage'] = "Type Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/incomtypes");
        }

        $data = $matrontype->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.incomtypesedit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function expenstypesedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronexpendtype();

        if (count($_POST) > 0 && Auth::access('matron')) {

            $matrontype->update($id, $_POST);

            $_SESSION['messsage'] = "Type Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/matrons/expentypes");
        }

        $data = $matrontype->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.expenstypesedit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function incomeedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronincometype();
        $incomes = new Matronincome();

        if (count($_POST) > 0 && Auth::access('matron')) {

            if ($incomes->validate($_POST)) {
                $incomes->update($id, $_POST);

                $_SESSION['messsage'] = "Income Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("/matrons/incomes");
            } else {
                $errors = $incomes->errors;
            }
        }

        $data = $incomes->where('id', $id)[0];
        $datatype = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "no";
        return $this->view('matrons.incomeedit', [
            'errors' => $errors,
            'row' => $data,
            'rowtype' => $datatype,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function expendedit($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $matrontype = new Matronexpendtype();
        $expends = new Matronexpend();

        if (count($_POST) > 0 && Auth::access('matron')) {

            if ($expends->validate($_POST)) {
                $expends->update($id, $_POST);

                $_SESSION['messsage'] = "Expenditure Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("/matrons/expenses");
            } else {
                $errors = $expends->errors;
            }
        }

        $data = $expends->where('id', $id)[0];
        $datatype = $matrontype->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "no";
        return $this->view('matrons.expendedit', [
            'errors' => $errors,
            'row' => $data,
            'rowtype' => $datatype,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function matronrecords()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $expenses = new Expense();

        $arr['semid'] = $_SESSION['semester']->id;

        $data = $expenses->query('SELECT it.typename, SUM(i.amount) AS total_amount FROM matronexpends i JOIN matronexpendtypes it ON i.typeid = it.id WHERE semesterid =:semid GROUP BY it.typename; ', $arr);

        $datatution = $expenses->query('SELECT ( SUM(`feedfeeghc`) + ( SELECT COALESCE(SUM(`amount`), 0) FROM `feedingarreas` WHERE `semesterid` =:semid AND `status` = 2 )) AS `total_feedingfees` FROM `fees` WHERE `semesterid` =:semid', $arr)[0];

        $dataexp = $expenses->query('SELECT it.typename, SUM(e.amount) AS total_amount FROM matronincomes e JOIN matronincometypes it ON e.typeid = it.id WHERE semesterid =:semid GROUP BY it.typename; ', $arr);

        if (isset($_POST['export'])) {
            $data = $expenses->query('SELECT it.typename, SUM(i.amount) AS total_amount FROM matronexpends i JOIN matronexpendtypes it ON i.typeid = it.id WHERE semesterid =:semid GROUP BY it.typename; ', $arr);
            $datatution = $expenses->query('SELECT ( SUM(`feedfeeghc`) + ( SELECT COALESCE(SUM(`amount`), 0) FROM `feedingarreas` WHERE `semesterid` =:semid AND `status` = 2 ) ) AS `total_feedingfees` FROM `fees` WHERE `semesterid` =:semid', $arr)[0];

            $dataexp = $expenses->query('SELECT it.typename, SUM(e.amount) AS total_amount FROM matronincomes e JOIN matronincometypes it ON e.typeid = it.id WHERE semesterid =:semid GROUP BY it.typename; ', $arr);

            if ($data) {
                $fields = array('Revenue', 'Amount (GHC)');
                $excelData = implode("\t", array_values($fields)) . "\n";

                if ($data) {
                    foreach ($data as $row) {
                        $lineData = array(
                            $row->typename,
                            esc(number_format($row->total_amount, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    if ($datatution->total_feedingfees) {
                        $lineData = array(
                            'Feeding Fees',
                            esc(number_format($datatution->total_feedingfees, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    $lineData = array('', '');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";

                    $lineData = array('Expenditure', 'Amount (GHC)');
                    $excelData .= implode("\t", array_values($lineData)) . "\n";

                    foreach ($dataexp as $row) {
                        $lineData = array(
                            $row->typename,
                            esc(number_format($row->total_amount, 2))
                        );
                        $excelData .= implode("\t", array_values($lineData)) . "\n";
                    }

                    export_data_to_excel($fields, $excelData, 'Matron_Income_Expenditure_Report');
                } else {
                    $excelData .= 'No records found...' . "\n";
                }
            }
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'metroaccount';
        $hiddenSearch = "nop";
        return $this->view('matrons.matronrecords', [
            'errors' => $errors,
            'rowtution' => $datatution,
            'rowsrev' => $data,
            'rowsexp' => $dataexp,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
