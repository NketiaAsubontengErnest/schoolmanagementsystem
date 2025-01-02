<?php

/**
 * Credits controller
 */
class Credits extends Controller
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

    function add()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $students = new Student();
        $fees = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            $students->query("UPDATE `students` SET `credit`=`credit`+:credit WHERE `studentid`=:studentid", $_POST);

            $_SESSION['messsage'] = "Student Credit Added Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";
            return $this->redirect("/credits/add");
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'credit';
        $hiddenSearch = "nop";
        return $this->view('credits.add', [
            'errors' => $errors,
            'rows' => $data,
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
        $students = new Student();
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($students->validate($_POST)) {
                $students->update($id, $_POST);

                $_SESSION['messsage'] = "Student Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("students");
            } else {
                $errors = $students->errors;
            }
        }

        $data = $students->where('id', $id)[0];
        $rowclass = $classes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'stude';
        $hiddenSearch = "no";
        return $this->view('students.edit', [
            'errors' => $errors,
            'row' => $data,
            'rowclass' => $rowclass,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
   
}
