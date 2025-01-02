<?php

/**
 * Classes controller
 */
class Classes extends Controller
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
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($classes->validate($_POST)) {
                $_SESSION['messsage'] = "Class Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $classes->insert($_POST);
                return $this->redirect("classes");
            } else {
                $errors = $classes->errors;
            }
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `classes` WHERE `classname` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list'=>'%'.$_GET['search_list'].'%',
            ];

            $data = $classes->findSearch($query,$arr);
        } else {
            $data = $classes->findAll($limit, $offset);
        }

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "yeap";
        return $this->view('classes', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
            'pager' => $pager,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
    function add($id)
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }

        $data = [];
        $datasubj = [];
        $dataassign = [];
        $errors = array();
        $classes = new Classe();
        $subjects = new Subject();
        $classsubj = new Classsubj();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            
            if (isset($_POST['delete'])) {
                $classsubj->delete($_POST['delete']);
                
                $_SESSION['messsage'] = "Subject Un-Assigned Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";
            } else {
                $_POST['classid'] = $id;
                if ($classsubj->validate($_POST)) {
                    $classsubj->insert($_POST);

                    $_SESSION['messsage'] = "Subject Assigned Successfully";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['status_headen'] = "Good job!";                    
                } else {
                    $errors = $classsubj->errors;
                }
            }
            return $this->redirect("classes/add/" . $id);
        }
        $data = $classes->where('id', $id)[0];
        $datasubj = $subjects->findAll();
        $dataassign = $classsubj->where('classid', $id);

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('classes.add', [
            'errors' => $errors,
            'row' => $data,
            'rows' => $dataassign,
            'rowsubjects' => $datasubj,
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
        $classes = new Classe();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            $classes->update($id, $_POST);

            $_SESSION['messsage'] = "Class Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("classes");
        }

        $data = $classes->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'setup';
        $hiddenSearch = "no";
        return $this->view('classes.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
