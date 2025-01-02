<?php
/**
 * home controller
 */
class Home extends Controller{
    function index(){
        $data1 = array();
        $data = array();
        
        $actives = 'home';
        $hiddenSearch  = '';
        $crumbs  = array();
        $this->view('home',[
            'rows1'=>$data1,
            'rows'=>$data,
            'crumbs'=>$crumbs,
            'hiddenSearch'=>$hiddenSearch,
            'actives'=>$actives
        ]);
    }
}