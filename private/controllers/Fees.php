<?php

/**
 * Fees controller
 */
class Fees extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $datafees = [];
        $arr = [];
        $errors = array();

        $fees = new Fee();
        $class = new Classe();

        $datafees = $fees->where('date', date("Y-m-d"));
        $query = "SELECT classes.* FROM classes LEFT JOIN fees ON classes.id = fees.classid AND fees.date = CURRENT_DATE WHERE fees.classid IS NULL;";
        $data = $class->findSearch($query, $arr);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'fees';
        $hiddenSearch = "NOP";
        return $this->view('fees', [
            'errors' => $errors,
            'rows' => $data,
            'rowsfee' => $datafees,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function accumulate()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $arr = [];
        $errors = array();

        $fees = new Fee();

        $arr = [
            'semesterid' => $_SESSION['semester']->id
        ];
        $query = "SELECT f.classid, SUM(f.schoolfeeghc) AS total_school_fees, SUM(f.classfeeghc) AS total_class_fee, ( SUM(f.feedfeeghc) + ( SELECT COALESCE(SUM(amount), 0) FROM feedingarreas fa WHERE fa.semesterid =:semesterid AND fa.status = 2 AND fa.classid = f.classid )) AS total_feeding_fee FROM fees f WHERE f.semesterid =:semesterid GROUP BY f.classid;";
        $data = $fees->findSearch($query, $arr);
        
        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "NOP";
        return $this->view('fees.accumulate', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function record($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $datafee = [];
        $rowsCredit = [];
        $errors = array();
        $fees = new Fee();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('assistfinance')) {
            if ($fees->validate($_POST)) {
                $_POST['classid'] = $id;
                $_POST['numnotpaid'] = $_POST['numberpresent'] - $_POST['numberpaid'];
                
                $fees->insert($_POST);
                
                $_SESSION['messsage'] = "Class Fees Paid Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("fees");
            } else {
                $errors = $fees->errors;
            }
        }

        $data = $classes->where('id', $id)[0];

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `fees` WHERE `classid` =:classid AND `date` =:search_list";
            $arr = [
                'classid'=> $id,
                'search_list'=> $_GET['search_list'],
            ];

            $datafee = $fees->findSearch($query, $arr);
        } else {
            $datafee = $fees->where('classid', $id);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'fees';
        $hiddenSearch = "date";
        return $this->view('fees.record', [
            'errors' => $errors,
            'row' => $data,
            'rowsfee' => $datafee,
            'rowsCredit' => $rowsCredit,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function addexamfee($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $datafee = [];
        $rowsCredit = [];
        $errors = array();
        $exams = new Examfee();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            if ($exams->validate($_POST)) {
                $_POST['classid'] = $id;
                $_POST['semesterid'] = $_SESSION['semester']->id;
                                
                $exams->insert($_POST);
                
                $_SESSION['messsage'] = "Class Exams Fee Paied Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("fees/addexamfee/$id");
            } else {
                $errors = $exams->errors;
            }
        }

        $data = $classes->where('id', $id)[0];

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `examfees` WHERE `classid`=:classid AND `date` =:search_list";
            $arr = [
                'search_list'=> $_GET['search_list'],
                'classid'=> $id,
            ];
            $datafee = $exams->findSearch($query,$arr);
        }else{
            $datafee = $exams->where('classid', $id);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'exams';
        $hiddenSearch = "date";
        return $this->view('fees.addexamfee', [
            'errors' => $errors,
            'row' => $data,
            'rowsfee' => $datafee,
            'rowsCredit' => $rowsCredit,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function editexamfee($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $datafee = [];
        $rowsCredit = [];
        $errors = array();
        $exams = new Examfee();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            if ($exams->validate($_POST)) {
                $_POST['classid'] = $id;
                $_POST['semesterid'] = $_SESSION['semester']->id;
                                
                $exams->insert($_POST);
                
                $_SESSION['messsage'] = "Class Exams Fee Paid Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("fees/addexamfee/$id");
            } else {
                $errors = $exams->errors;
            }
        }
        $datafee = $exams->where('id', $id)[0];

        $data = $classes->where('id', $datafee->classid)[0];


        $crumbs[] = ['Dashboard', ''];
        $actives = 'exams';
        $hiddenSearch = "yeap";
        return $this->view('fees.editexamfee', [
            'errors' => $errors,
            'row' => $data,
            'rowsfee' => $datafee,
            'rowsCredit' => $rowsCredit,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function examination()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $rowsCredit = [];
        $errors = array();
        $classes = new Classe();

        $data = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'exams';
        $hiddenSearch = "no";

        return $this->view('fees.examination', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function clearances()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = [];
        $rowsCredit = [];
        $errors = array();
        $classes = new Classe();

        $data = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'clearfees';
        $hiddenSearch = "no";

        return $this->view('fees.clearances', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function clearclass($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $datafees = [];
        $arr = [];
        $errors = array();

        $fees = new Fee();
        $class = new Classe();

        $classdata = $class->where('id', $id);

        if (isset($_GET['search_list'])) {
            $arr = [
                'classid'=>$id,
                'usedate'=> $_GET['search_list']
            ];
            $data = $fees->where_query("SELECT * FROM fees WHERE fees.date =:usedate AND fees.classid =:classid", $arr);
        } else {
            $data = $fees->where('classid', $id);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'clearfees';
        $hiddenSearch = "date";

        return $this->view('fees.clearclass', [
            'errors' => $errors,
            'rows' => $data,
            'row' => $classdata,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function attendancelist($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $arr = [];
        $errors = array();
        $clases = new Classe();
        $attendances = new Attendance();

        $clas = $clases->where('id', $id)[0];
        $arr = [
            'classid'=>$id,
            'usedate'=> $_GET['datestouse']
        ];
        
        $data = $attendances->where_query("SELECT * FROM attendances WHERE attendances.date =:usedate AND attendances.classid =:classid", $arr);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'clearfees';
        $hiddenSearch = "no";

        return $this->view('fees.attendancelist', [
            'errors' => $errors,
            'rows' => $data,
            'row' => $clas,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function clearance($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $fees = new Fee();
        $attence = new Attendance();

       
        $data = $fees->where_query("SELECT * FROM `fees` WHERE `classid`=:classid AND `date` =:usedate", [
            'classid' => $id,
            'usedate' => $_GET['datestouse'],
        ])[0];

        if (count($_POST) > 0 && Auth::access('administrator')) {

            $totalNumber = 1;
            $totalSchoolfee = $totalNumber * $data->classes->schoolfee;
            $totalClassefee = $totalNumber * $data->classes->classesfee;

            $arr = [
                'numnotpaid' => $totalNumber,
                'numberpaid' => $totalNumber,
                'schoolfeeghc' => $totalSchoolfee,
                'classfeeghc' => $totalClassefee,
                'usedid' => $data->id,
            ];
            
            $fees->query("UPDATE `fees` SET `numberpaid`=`numberpaid`+:numberpaid ,`schoolfeeghc`=`schoolfeeghc`+:schoolfeeghc,`classfeeghc`=`classfeeghc`+:classfeeghc,`numnotpaid`=`numnotpaid`-:numnotpaid WHERE `id` =:usedid", $arr);

            $attence-> query("UPDATE `attendances` SET `credited`=1 WHERE `id` =". $_POST['clearstud']);

            $_SESSION['messsage'] = "Student Cleared Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("fees/clearance/$id?datestouse=".$_GET['datestouse']);
        }

        $data = $fees->where_query("SELECT * FROM `fees` WHERE `classid`=:classid AND `date` =:usedate", [
            'classid' => $id,
            'usedate' => $_GET['datestouse'],
        ])[0];

        $datas = $attence->where_query("SELECT * FROM `attendances` WHERE `credited` = 2 AND `classid` =:classid AND `date` =:usedate", [
            'classid' => $id,
            'usedate' => $_GET['datestouse'],
        ]);


        $crumbs[] = ['Dashboard', ''];
        $actives = 'fees';
        $hiddenSearch = "no";
        return $this->view('fees.clearance', [
            'errors' => $errors,
            'row' => $data,
            'rows' => $datas,
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
        $fees = new Fee();

        if (count($_POST) > 0 && Auth::access('assistfinance')) {

            if ($fees->validate($_POST)) {
                $fees->update($id, $_POST);

                $_SESSION['messsage'] = "Class Fees Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("fees");
            } else {
                $errors = $fees->errors;
            }
        }

        $data = $fees->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'fees';
        $hiddenSearch = "no";
        return $this->view('fees.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
