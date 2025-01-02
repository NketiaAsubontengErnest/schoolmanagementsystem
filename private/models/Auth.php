<?php

/**
 * Authentication class
 */
class Auth
{
    public static function authenticate($row)
    {
        $_SESSION['EMMANUELACDUSER'] = $row;
    }

    public static function logout()
    {
        if (isset($_SESSION['EMMANUELACDUSER'])) {
            if (isset($_SESSION['seasondata'])) {
                unset($_SESSION['seasondata']);
            }
            unset($_SESSION['EMMANUELACDUSER']);
            session_unset();
            session_destroy();
        }
    }

    public static function logged_in()
    {
        if (isset($_SESSION['EMMANUELACDUSER'])) {
            return true;
        }
        return false;
    }
    public static function user()
    {
        if (isset($_SESSION['EMMANUELACDUSER'])) {
            return $_SESSION['EMMANUELACDUSER']->firstname;
        }
        return false;
    }

    public static function get_image()
    {
        if (isset($_SESSION['EMMANUELACDUSER'])) {
            return $_SESSION['EMMANUELACDUSER']->imagelink;
        }
        return false;
    }

    public static function comparepass()
    {
        //$user = password_hash($_SESSION['EMMANUELACDUSER']->username, PASSWORD_DEFAULT);
        if (password_verify($_SESSION['EMMANUELACDUSER']->username, $_SESSION['EMMANUELACDUSER']->password)) {
            return true;
        }
        return false;
    }

    public static function __callStatic($method, $params)
    {
        $prop = strtolower(str_replace("get", "", $method));
        if (isset($_SESSION['EMMANUELACDUSER']->$prop)) {
            return $_SESSION['EMMANUELACDUSER']->$prop;
        }
        return "Unknown";
    }

    public static function access($rank = 'Teacher')
    {
        if (!isset($_SESSION['EMMANUELACDUSER'])) {
            return false;
        }
        $logged_in_rank = $_SESSION['EMMANUELACDUSER']->rank; //the rank for current user
        $RANK['proprietor']     = ['proprietor', 'administrator', 'headmaster', 'assistfinance', 'assistacademic', 'teacher', 'multimedia', 'matron'];
        $RANK['multimedia']     = ['multimedia', 'administrator', 'headmaster', 'assistfinance', 'assistacademic', 'teacher', 'matron'];
        $RANK['administrator']  = ['administrator', 'headmaster', 'assistfinance', 'assistacademic', 'teacher', 'matron'];
        $RANK['headmaster']     = ['headmaster', 'assistfinance', 'assistacademic', 'teacher'];
        $RANK['matron']         = ['matron'];
        $RANK['assistfinance']  = ['assistfinance', 'teacher'];
        $RANK['assistacademic'] = ['assistacademic', 'teacher'];
        $RANK['teacher']        = ['teacher'];
        
        if (!isset($RANK[$logged_in_rank])) {
            return false;
        }

        if (in_array($rank, $RANK[$logged_in_rank])) {
            return true;
        }
        return false;
    }
}
