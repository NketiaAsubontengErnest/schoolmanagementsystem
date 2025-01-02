<?php

/**
 * Incomtypes controller
 */
class Incomtypes extends Controller
{
    function index()
    {
        if (!Auth::logged_in()) {
            $this->redirect('login');
        }
        $data = [];
        $errors = array();

        $incomtypes = new Incomtype();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            if ($incomtypes->validate($_POST)) {
                $_SESSION['messsage'] = "income Type Added Successfully";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_headen'] = "Good job!";

                $incomtypes->insert($_POST);
                return $this->redirect("incomtypes");
            } else {
                $errors = $incomtypes->errors;
            }
        }

        $data = $incomtypes->findAll();

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "yeap";
        return $this->view('incomtypes', [
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
        $incomtypes = new Incomtype();

        if (count($_POST) > 0 && Auth::access('administrator')) {
            $incomtypes->update($id, $_POST);

            $_SESSION['messsage'] = "Income Type Updated Successfully";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_headen'] = "Good job!";

            return $this->redirect("incomtypes");
        }

        $data = $incomtypes->where('id', $id)[0];

        $crumbs[] = ['Dashboard', ''];
        $actives = 'expend';
        $hiddenSearch = "no";
        return $this->view('incomtypes.edit', [
            'errors' => $errors,
            'row' => $data,
            'crumbs' => $crumbs,
            'hiddenSearch' => $hiddenSearch,
            'actives' => $actives,
        ]);
    }
}
