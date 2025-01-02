<?php

/**
 * Cfarates controller
 */
class Cfarates extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) 
        {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();
        
        $cfarates = new Cfarate();

        if (count($_POST) > 0 && Auth::access('administrator')) 
        {
            if ($cfarates->validate($_POST)) 
            {
                $_SESSION['messsage'] = "CFA Amount Set Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $cfarates->insert($_POST);
                return $this->redirect("cfarates");
            } else 
            {
                $errors = $cfarates->errors;
            }
        }

        $data = $cfarates->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'cfarate';
        $hiddenSearch = "no";
        return $this->view('cfarates', [
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
        $cfarates = new Cfarate();

        if (count($_POST) > 0 && Auth::access('administrator')) {

            if ($cfarates->validate($_POST)) {
                $cfarates->update($id, $_POST);

                $_SESSION['messsage'] = "CFA Amount Updated Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                return $this->redirect("cfarates");
            } else {
                $errors = $cfarates->errors;
            }
        }

        $data = $cfarates->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'cfarate';
        $hiddenSearch = "no";
        return $this->view('cfarates.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
