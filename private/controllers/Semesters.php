<?php

/**
 * Semesters controller
 */
class Semesters extends Controller
{
    function index() 
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }        
        // Setting pagination
        $limit = 9;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $dataacd = [];
        $errors = array();
        $semesters = new Semester();
        $academicyears = new Academicyear();

        if (count($_POST) > 0 && Auth::access('assistacademic')) {
            if ($semesters->validate($_POST)) {                
                $semesters->insert($_POST);

                $_SESSION['messsage'] = "Semester Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("semesters");
            } else {
                $errors = $semesters->errors;
            }
        }
        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `semesters` WHERE `semester` LIKE :search_list ORDER BY id DESC LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list'=>'%'.$_GET['search_list'].'%',
            ];

            $data = $semesters->findSearch($query,$arr);
        } else {
            $data = $semesters->findAll($limit, $offset, 'DESC');
        }

        $dataacd = $academicyears->findAll(rotations: 'DESC');

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "yeap";
        return $this->view('semesters', [
            'errors' => $errors,
            'rows' => $data,
            'rowsacd' => $dataacd,
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
        $dataacd = [];
        $errors = array();
        $semesters = new Semester();
        $academicyears = new Academicyear();

        if (count($_POST) > 0 && Auth::access('assistacademic')) {
            if ($semesters->validate($_POST)) {
                $semesters->update($id, $_POST);

                $_SESSION['messsage'] = "Semester Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("semesters");
            } else {
                $errors = $semesters->errors;
            }
        }

        $data = $semesters->where('id', $id)[0];
        $dataacd = $academicyears->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('semesters.edit', [
            'errors' => $errors,
            'row' => $data,
            'rowsacd' => $dataacd,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
