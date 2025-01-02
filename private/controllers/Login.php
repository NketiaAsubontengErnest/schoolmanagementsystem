<?php
/**
 * Login controller
 */
class Login extends Controller{
    function index($id = null){
        $errors = array();
        if (count($_POST) > 0) {
            $user = new User();

            if($row = $user->where('staffid', $_POST['staffid'])){
                $row = $row[0];       
                if(password_verify($_POST['password'], $row->password)){
                    if($row->active == 0){
                        Auth::authenticate($row);
                        return $this->redirect('dashboard'); 
                    }else{
                        $errors['blocked'] = "You have been blocked by directors";
                    }
                    
                }else{
                    $errors['authlogin'] = "Invalid username or password";  
                }                    
            }else{
                $errors['authlogin'] = "Invalid username or password";  
            }
                          
        }
        return $this->view('login',[
            'errors'=>$errors,
        ]);
    }
}