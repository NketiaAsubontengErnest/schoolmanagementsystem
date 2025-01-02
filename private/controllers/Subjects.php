<?php

/**
 * subjects controller
 */
class Subjects extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) 
        {
            $this->redirect('login');
        }
        // Setting pagination
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        
        $subjects = new Subject();

        if (count($_POST) > 0 && Auth::access('administrator')) 
        {
            if ($subjects->validate($_POST)) 
            {
                $_POST['title'] = strtoupper($_POST['title']);
                $subjects->insert($_POST);
                $_SESSION['messsage'] = "Subject Type Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("subjects");
            } else 
            {
                $errors = $subjects->errors;
            }
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `subjects` WHERE `title` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list'=>'%'.$_GET['search_list'].'%',
            ];

            $data = $subjects->findSearch($query,$arr);
        } else {
            $data = $subjects->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "yeap";
        return $this->view('subjects', [
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
        if (!Auth::logged_in()) 
        {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        $subjects = new Subject();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($subjects->validate($_POST)) {
                $_POST['title'] = strtoupper($_POST['title']);
                $subjects->update($id, $_POST);

                $_SESSION['messsage'] = "Subject Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("subjects");
            } else {
                $errors = $subjects->errors;
            }
        }

        $data = $subjects->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('subjects.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
