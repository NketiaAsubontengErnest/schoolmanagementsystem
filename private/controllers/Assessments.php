<?php

/**
 * Assessments controller
 */
class Assessments extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();

        $subject = new Classsubj();

        $data = $subject->where('classid', Auth::getStaff()->clsses->id);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'assess';
        $hiddenSearch = "yeap";
        return $this->view('assessments', [
            'errors' => $errors,
            'crumbs' => $crumbs,
            'rows' => $data,
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
        $actives = 'assess';
        $hiddenSearch = "no";
        return $this->view('expentypes.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function marks($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $assign = new Assessment();

        if (count($_POST) > 0 && Auth::access('teacher')) {
            $assign->update($id, $_POST);

            $_SESSION['messsage'] = "Marks Edited Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("/assessments/students/" . $_GET['school']);
        }

        $data = $assign->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'assess';
        $hiddenSearch = "no";
        return $this->view('assessments.marks', [
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
        $dataAs = [];
        $errors = array();
        $students = new Student();
        $attendances = new Attendance();

        if (count($_POST) > 0 && Auth::access('teacher')) {

            if (isset($_POST['present'])) {
                $_POST['studentnumber'] = $_POST['present'];
                $_POST['status'] = 'present';
                $_POST['classid'] = $id;
                $_POST['userid'] = Auth::getStaff()->id;
                $_POST['semesterid'] = $_SESSION['semester']->id;
            }
            if (isset($_POST['upsent'])) {
                $_POST['studentnumber'] = $_POST['upsent'];
                $_POST['status'] = 'upsent';
                $_POST['classid'] = $id;
                $_POST['userid'] = Auth::getStaff()->id;
                $_POST['semesterid'] = $_SESSION['semester']->id;
            }

            $attendances->insert($_POST);
            return $this->redirect("/attendances/take/$id");
        }

        $data = $students->query("SELECT * FROM students LEFT JOIN attendances ON students.studentid = attendances.studentnumber AND attendances.date = CURRENT_DATE WHERE attendances.studentnumber IS NULL AND students.classid =$id");
        //$dataAs = $students->query("SELECT * FROM students LEFT JOIN attendances ON students.studentid = attendances.studentnumber AND attendances.date = CURRENT_DATE WHERE attendances.studentnumber IS NOT NULL AND students.classid =$id");

        $crumbs[] = ['Dashboard', ''];
        $actives = 'assess';
        $hiddenSearch = "yeap";
        return $this->view('attendances.take', [
            'errors' => $errors,
            'rows' => $data,
            //'rowsAs' => $dataAs,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }

    function students($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $dataAs = [];
        $errors = array();
        $students = new Student();
        $assessments = new Assessment();
        $subj = new Subject();

        $arr = [
            'subjid' => $id,
            'semesterid' => $_SESSION['semester']->id,
            'classid' => Auth::getStaff()->clsses->id,
        ];

        if (count($_POST) > 0 && Auth::access('teacher')) {
            $_POST = array_merge($arr, $_POST);
            if ($assessments->validate($_POST)) {

                $assessments->insert($_POST);

                $_SESSION['messsage'] = "Result Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("/assessments/students/$id");
            } else {
                $_SESSION['messsage'] = $assessments->errors['subjid'];
                $_SESSION['status_code'] = "error";
                $_SESSION['status_headen'] = "OOPS!";
            }
        }

        $subjdata = $subj->where('id', $id)[0];

        $data = $students->query("
            SELECT students.*, assessments.id AS assessment_id, assessments.subjid, assessments.semesterid, assessments.contasses, assessments.exammark FROM students LEFT JOIN assessments 
                ON students.studentid = assessments.studentid 
                AND assessments.semesterid = :semesterid 
                AND assessments.subjid = :subjid
            WHERE students.classid = :classid 
            AND assessments.studentid IS NULL AND students.activenes = 0; 
        ", $arr);

        $dataAs = $students->query("
            SELECT students.*, assessments.id AS assessment_id, assessments.subjid, assessments.semesterid, assessments.contasses, assessments.exammark FROM students LEFT JOIN assessments 
                ON students.studentid = assessments.studentid 
                AND assessments.semesterid = :semesterid 
                AND assessments.subjid = :subjid
            WHERE students.classid = :classid 
            AND assessments.studentid IS NOT NULL AND students.activenes = 0; 
        ", $arr);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'assess';
        $hiddenSearch = "yeap";
        return $this->view('assessments.students', [
            'errors' => $errors,
            'rows' => $data,
            'classid' => $id,
            'rowsAs' => $dataAs,
            'crumbs' => $crumbs,
            'subjdata' => $subjdata,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
