<?php

/**
 * 
 * Student Model
 */
class Student extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'health_insurance',
        'address',
        'nationality',
        'mother_name',
        'mother_phone',
        'father_name',
        'father_phone',
        'emegency_name',
        'emegency_phone',
        'emegency_location',
        'classid',
        'credit',
        'semesterid',
        'image',
    ];

    protected $beforeInset = [
        'make_student_id'
    ];

    protected $afterSelect = [
        'get_Sem',
        'get_Attedance',
        'get_Class_Type',
    ];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['first_name'])) {
            $this->errors['first_name'] = "First name can't be empty";
        }
        if (empty($data['first_name']) || !preg_match('/^[a-z A-Z-]+$/', $data['first_name'])) {
            $this->errors['first_name'] = "Only letters allowed in first name";
        }
        if (empty($data['last_name'])) {
            $this->errors['last_name'] = "First name can't be empty";
        }
        if (empty($data['last_name']) || !preg_match('/^[a-z A-Z-]+$/', $data['last_name'])) {
            $this->errors['last_name'] = "Only letters allowed in Last name";
        }
        if (empty($data['gender'])) {
            $this->errors['gender'] = "Please select the gender";
        }
        if (empty($data['date_of_birth'])) {
            $this->errors['date_of_birth'] = "Please select the date of birth";
        }
        if (empty($data['address'])) {
            $this->errors['address'] = "Address can't be empty";
        }        
        if (empty($data['nationality'])) {
            $this->errors['nationality'] = "Please select the nationality";
        }
        if (empty($data['emegency_name'])) {
            $this->errors['emegency_name'] = "Emegency contact name can't be empty";
        }
        if (empty($data['emegency_phone'])) {
            $this->errors['emegency_phone'] = "Emegency contact Number can't be empty";
        }
        if (empty($data['emegency_location'])) {
            $this->errors['emegency_location'] = "Emegency contact location can't be empty";
        }
        if (empty($data['classid'])) {
            $this->errors['classid'] = "Plaese select class";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_student_id($data)
    {
        $ids = $this->selctingId()[0]->studentid;

        $ids = substr($ids, 4);

        $ids++;
        if ($ids < 10) {
            $ids = "0000" . $ids;
        } elseif ($ids < 100) {
            $ids = "000" . $ids;
        } elseif ($ids < 1000) {
            $ids = "00" . $ids;
        } elseif ($ids < 10000) {
            $ids = "0" . $ids;
        }
        $data['studentid'] = date('Y') . $ids;
        return $data;
    } 

    public function get_Class_Type($data)
    {
        $classes = new Classe();
        foreach ($data as $key => $row) {
            $result = $classes->where('id', $row->classid);
            $data[$key]->class = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
    
    public function get_Attedance($data)
    {
        $sems = $_SESSION['semester']->id;
        $attends = new Attendance();
        foreach ($data as $key => $row) {
            $result = $attends->query("SELECT COUNT(*) AS attended FROM `attendances` WHERE `studentnumber` =$row->studentid AND semesterid = $sems AND `status` = 'present'");
            $data[$key]->attends = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Sem($data)
    {
        $sems = new Semester();
        foreach ($data as $key => $row) {
            $result = $sems->where('id', $row->semesterid);
            $data[$key]->semester = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
