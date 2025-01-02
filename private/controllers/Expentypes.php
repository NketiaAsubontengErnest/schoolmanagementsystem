<?php

/**
 * Expentypes controller
 */
class Expentypes extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) 
        {
            $this->redirect('login');
        }
        $limit = 10;
        $pager = new Pager($limit);
        $offset = $pager->offset;

        $data = [];
        $errors = array();
        
        $expentype = new Expentype();

        if (count($_POST) > 0 && Auth::access('administrator')) 
        {
            if ($expentype->validate($_POST)) 
            {
                $_SESSION['messsage'] = "Expenditure Type Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $expentype->insert($_POST);
                return $this->redirect("expentypes");
            } else 
            {
                $errors = $expentype->errors;
            }
        }

        if (isset($_GET['search_list'])) {
            $query = "SELECT * FROM `expentypes` WHERE `expntype` LIKE :search_list LIMIT $limit OFFSET $offset";
            $arr = [
                'search_list'=>'%'.$_GET['search_list'].'%',
            ];
            
            $data = $expentype->findSearch($query,$arr);
        }else{
            $data = $expentype->findAll($limit, $offset);
        }

        

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "yeap";
        return $this->view('expentypes', [
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
        $expentype = new Expentype();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($expentype->validate($_POST)) {
                $expentype->update($id, $_POST);

                $_SESSION['messsage'] = "Expenditure Type Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("expentypes");
            } else {
                $errors = $expentype->errors;
            }
        }

        $data = $expentype->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('expentypes.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
