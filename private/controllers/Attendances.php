<?php

/**
 * Attendances controller
 */
class Attendances extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        // $clases = new Classe();

        // show(Auth::getStaff());
        // die;

        $crumbs[] = ['Dashboard', ''];
        $actives = 'attend';
        $hiddenSearch = "yeap";
        return $this->view('attendances', [
            'errors' => $errors,
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
        $expentype = new Expentype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($expentype->validate($_POST)) {
                $expentype->update($id, $_POST);

                $_SESSION['messsage'] = "Attendance Marked Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("expentypes");
            } else {
                $errors = $expentype->errors;
            }
        }

        $data = $expentype->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'attend';
        $hiddenSearch = "no";
        return $this->view('expentypes.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
    function take($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $dataAt = [];
        $errors = array();
        $students = new Student();
        $clases = new Classe();
        $attendances = new Attendance();

        if (count($_POST) > 0 && Auth::access('teacher')) {

            if (isset($_POST['paid'])) {
                $std = $students->where('studentid', $_POST['paid'])[0];
                $_POST['studentnumber'] = $_POST['paid'];
                $_POST['status'] = 'present';
                $_POST['classid'] = $id;
                $_POST['schoolfee'] = $std->class->schoolfee;
                $_POST['classfee'] = $std->class->classesfee;
                $_POST['credited'] = 1;
                $_POST['semesterid'] = $_SESSION['semester']->id;

                $_SESSION['messsage'] = "Student '". $std->first_name ."' marked present & paid Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }

            if (isset($_POST['unpaid'])) {
                $std = $students->where('studentid', $_POST['unpaid'])[0];
                $_POST['studentnumber'] = $_POST['unpaid'];
                $_POST['status'] = 'present';
                $_POST['schoolfee'] = $std->class->schoolfee;
                $_POST['classfee'] = $std->class->classesfee;
                $_POST['credited'] = 2;
                $_POST['classid'] = $id;
                $_POST['semesterid'] = $_SESSION['semester']->id;   
                
                $_SESSION['messsage'] = "Student '". $std->first_name ."' marked present  & unpaid Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }

            if (isset($_POST['absent'])) {
                $std = $students->where('studentid', $_POST['absent'])[0];
                $_POST['studentnumber'] = $_POST['absent'];
                $_POST['status'] = 'absent';
                $_POST['classid'] = $id;
                $_POST['schoolfee'] = 0.0;
                $_POST['classfee'] = 0.0;
                $_POST['credited'] = 3;
                $_POST['semesterid'] = $_SESSION['semester']->id;

                $_SESSION['messsage'] = "Student '". $std->first_name ."' marked absent Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            }

            $attendances->insert($_POST);
            return $this->redirect("/attendances/take/$id");
        }
        $clas = $clases->where('id', $id)[0];

        $data = $students->query("SELECT * FROM students LEFT JOIN attendances ON students.studentid = attendances.studentnumber AND attendances.date = CURRENT_DATE WHERE attendances.studentnumber IS NULL AND students.classid =$id AND students.activenes = 0");
        $dataAt = $students->query("SELECT * FROM students LEFT JOIN attendances ON students.studentid = attendances.studentnumber AND attendances.date = CURRENT_DATE WHERE attendances.studentnumber IS NOT NULL AND students.classid =$id AND students.activenes = 0");

        $crumbs[] = ['Dashboard', ''];
        $actives = 'attend';
        $hiddenSearch = "yeap";
        return $this->view('attendances.take', [
            'errors' => $errors,
            'rows' => $data,
            'row' => $clas,
            'rowsAt' => $dataAt,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
