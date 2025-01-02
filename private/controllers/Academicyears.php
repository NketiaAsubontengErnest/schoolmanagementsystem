<?php

/**
 * Academicyears controller
 */
class Academicyears extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }                
        // Setting pagination
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        $academicyears = new Academicyear();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($academicyears->validate($_POST)) {                
                $academicyears->insert($_POST);

                $_SESSION['messsage'] = "Academic Years Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
                return $this->redirect("academicyears");
            } else {
                $errors = $academicyears->errors;
            }
        }
        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `academicyears` WHERE `academicyear` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list'=>'%'.$_GET['search_list'].'%',
            ];

            $data = $academicyears->findSearch($query,$arr);
        } else {
            $data = $academicyears->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "yeap";
        return $this->view('academicyears', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'pager' => $pager,
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
        $academicyears = new Academicyear();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($academicyears->validate($_POST)) {
                $academicyears->update($id, $_POST);

                $_SESSION['messsage'] = "Academic Years Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("academicyears");
            } else {
                $errors = $academicyears->errors;
            }
        }

        $data = $academicyears->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('academicyears.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
