<?php

/**
 * Assignclasses controller
 */
class Assignclasses extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) 
        {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        
        $classsubjs = new Classsubj();

        
        $data = $classsubjs->where('','');

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('expentypes', [
            'errors' => $errors,
            'rows' => $data,
            'crumbs' => $crumbs,
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
