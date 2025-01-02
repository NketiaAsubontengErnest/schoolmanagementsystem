<?php

/**
 * Dashboard controller
 */
class Dashboard extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 3;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $ss = [];
        $datainc = [];

        $semester = new Semester();
        $students = new Student();
        $expenses = new Expense();
        $emps = new Employee();

        $totalIncom = 00.00;
        $totalExped = 00.00;

        $sems = $semester->findAll($limit, $offset, 'DESC');

        if (count($_POST) > 0 && isset($_POST['semes'])) {
            $_SESSION['semester'] = $data['semester'] = $semester->where('id', $_POST['semes'])[0];
        } else {
            //get current semester
            $ss = $semester->selctingLastId();
        }

        if (!isset($_SESSION['semester'])) {
            $arr['semesterid'] = isset($ss[0]->id) ? $ss[0]->id : '';
            $_SESSION['semester'] = $ss[0];
            $data['semesterid'] = $ss[0];
        } else {
            $arr['semesterid'] = $_SESSION['semester']->id;
            $data['semester'] = $_SESSION['semester'];
        }
        $semss = $arr['semesterid'] = $_SESSION['semester']->id;
        if (Auth::getRank() != 'teacher' && Auth::getRank() != 'matron') {
            $studdata = $students->selectCountWhere('activenes', 0)[0];
            $stugenddata = $students->query('SELECT gender, COUNT(*) AS count FROM students WHERE `activenes` = 0 GROUP BY gender;');

            $arrs['semid'] = $_SESSION['semester']->id;

            $datainc = $expenses->query('SELECT it.incomtypename, SUM(i.amount) AS total_amount FROM incomes i JOIN incomtypes it ON i.typeid = it.id WHERE semid =:semid GROUP BY it.incomtypename', $arrs);
            $datapta = $expenses->query('SELECT SUM(`amount`) total_pta FROM `ptafees` WHERE `semesterid` =:semid ', $arrs)[0];
            $dataexamf = $expenses->query('SELECT SUM(`amount`) total_examf FROM `examfees` WHERE `semesterid` =:semid ', $arrs)[0];
            $datatution = $expenses->query('SELECT SUM(`schoolfeeghc` + `classfeeghc`) AS total_tuitionfees FROM `fees` WHERE `semesterid` =:semid', $arrs)[0];
            $dataexp = $expenses->query('SELECT it.expntype, SUM(e.amount) AS total_amount FROM expenses e JOIN expentypes it ON e.typeid = it.id WHERE semid =:semid GROUP BY it.expntype;', $arrs);
            $dataarres = $expenses->query('SELECT SUM(`numnotpaid` * (SELECT classes.schoolfee + classes.classesfee FROM classes WHERE classes.id = fees.classid)) AS total_arearse FROM `fees` WHERE `semesterid` =:semesterid', ['semesterid' => $_SESSION['semester']->id])[0];
            $dataempstr = $emps->selectCountWhere('activenes', '0', 'strength')[0];


            if ($datainc) {
                foreach ($datainc as $incom) {
                    $totalIncom += $incom->total_amount;
                }
            }

            $totalIncom += $datapta->total_pta;
            $totalIncom += $dataexamf->total_examf;
            $totalIncom += $datatution->total_tuitionfees;
            if ($dataexp) {
                foreach ($dataexp as $exp) {
                    $totalExped += $exp->total_amount;
                }
            }
        }elseif(Auth::getRank() == 'matron'){
            $studdata = $students->selectCountWhere('activenes', 0)[0];
            $stugenddata = $students->query('SELECT gender, COUNT(*) AS count FROM students WHERE `activenes` = 0 GROUP BY gender;');

            $arrs['semid'] = $_SESSION['semester']->id;

            $datainc = $expenses->query('SELECT it.typename, SUM(i.amount) AS total_amount FROM matronincomes i JOIN matronincometypes it ON i.typeid = it.id WHERE semesterid =:semid GROUP BY it.typename', $arrs);
            $datatution = $expenses->query('SELECT SUM(`feedfeeghc`) AS total_feedingfees FROM `fees` WHERE `semesterid` =:semid', $arrs)[0];
            $dataarres = $expenses->query('SELECT SUM(`amount`) AS total_arearse FROM `feedingarreas` WHERE `semesterid` =:semesterid  AND `status` =:status', ['semesterid' => $_SESSION['semester']->id, 'status'=>1])[0];
            $dataarrespay = $expenses->query("SELECT SUM(`amount`) AS total_arrearspay FROM `feedingarreas` WHERE `semesterid` =:semesterid AND `status` =:status", ['semesterid' => $_SESSION['semester']->id, 'status'=>2])[0];
            $dataempstr = $emps->selectCountWhere('activenes', '0', 'strength')[0];


            if ($datainc) {
                foreach ($datainc as $incom) {
                    $totalIncom += $incom->total_amount;
                }
            }

            $totalIncom += $datatution->total_feedingfees;

            if($dataarrespay){
                $totalIncom += $dataarrespay->total_arrearspay;
            }

        } else {
            $totalIncom = [];
            $clsid = (Auth::getStaff()->assignclass);

            $studdata = $students->query("SELECT COUNT(*) AS numbers FROM students WHERE `activenes` = 0 AND `classid` = $clsid")[0];
            $stugenddata = $students->query("SELECT gender, COUNT(*) AS count FROM students WHERE `activenes` = 0 AND `classid` = $clsid GROUP BY gender;");


            $arrs['semid'] = $_SESSION['semester']->id;

            $totalIncom['income'] = $expenses->query("SELECT SUM(`schoolfee` + `classfee`) AS total_fee FROM `attendances` WHERE `classid` = $clsid AND date = CURRENT_DATE AND `credited` = 1")[0];
            $totalIncom['credit_income'] = $expenses->query("SELECT SUM(`schoolfee` + `classfee`) AS total_cred_fee FROM `attendances` WHERE `classid` = $clsid AND date = CURRENT_DATE AND `credited` = 2")[0];
            $datapta = $expenses->query('SELECT SUM(`amount`) total_pta FROM `ptafees` WHERE `semesterid` =:semid ', $arrs)[0];
            $dataexamf = $expenses->query('SELECT SUM(`amount`) total_examf FROM `examfees` WHERE `semesterid` =:semid ', $arrs)[0];
            $datatution = $expenses->query('SELECT SUM(`schoolfeeghc` + `classfeeghc`) AS total_tuitionfees FROM `fees` WHERE `semesterid` =:semid', $arrs)[0];
            $dataexp = $expenses->query('SELECT it.expntype, SUM(e.amount) AS total_amount FROM expenses e JOIN expentypes it ON e.typeid = it.id WHERE semid =:semid GROUP BY it.expntype;', $arrs);
            $dataarres = $expenses->query("SELECT SUM(`schoolfee` + `classfee`) AS total_arearse FROM `attendances` WHERE `classid` = $clsid AND `semesterid` = $semss AND `credited` = 2")[0];
            $dataempstr = $emps->selectCountWhere('activenes', '0', 'strength')[0];
        }

        $empenddata = $emps->query('SELECT gender, COUNT(*) AS count FROM employees WHERE `activenes` = 0 GROUP BY gender;');


        $msg = " Logged in successfully";
        $crumbs[] = ['Dashboard', ''];
        $actives = 'dashb';
        $hiddenSearch = "nop";
        return $this->view('dashboard', [
            'rows' => $data,
            'crumbs' => $crumbs,
            'sems' =>  $sems,
            'studNum' =>  $studdata,
            'studgenNum' =>  $stugenddata,
            'empsgenNum' =>  $empenddata,
            'totalIncom' =>  $totalIncom,
            'totalExpend' =>  $totalExped,
            'rowsinc' =>  $datainc,
            'dataarres' =>  $dataarres,
            'rowempstr' =>  $dataempstr,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
            'msg' => $msg
        ]);
    }
}
