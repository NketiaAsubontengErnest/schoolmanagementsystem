<?php

/**
 * 
 * Assessment Model
 */
class Assessment extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'studentid',
        'subjid',
        'classid',
        'semesterid',
        'contasses',
        'exammark',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_Subject',
        'get_Student',
    ];

    public function validate($data)
    {
        $this->errors = array();
        $this->errors['subjid'] = "";
        //checking errors for first name
        if (empty($data['studentid'])) {            
            $this->errors['subjid'] .= "Select Student, ";
        }
        if (empty($data['contasses'])) {
            $this->errors['subjid'] .= "Enter Continues Assessment, ";
        }
        //check if class exists
        if (($data['contasses']) > 50) {
            $this->errors['subjid'] .= "Continues Assessment can't be more than 50, ";
        }
        if (($data['exammark']) > 50) {
            $this->errors['subjid'] = "Exam Marks can't be more than 50, ";
        }
        //check if class exists
        if ($this->query('SELECT * FROM `assessments` WHERE `studentid` =' . $_POST['studentid'] . ' AND `semesterid` =' . $_POST['semesterid'] .' AND `subjid` =' . $_POST['subjid'])) {
            $this->errors['subjid'] .= "Assessement alrady added for student";
        }

        //check if the errors are empty
        if ($this->errors['subjid'] == "") {
            return true;
        }
        return false;
    }

    public function get_Subject($data)
    {
        $subjects = new Subject();
        foreach ($data as $key => $row) {
            $result = $subjects->where('id', $row->subjid);
            $data[$key]->subject = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
    public function get_Student($data)
    {
        $students = new Student();
        foreach ($data as $key => $row) {
            $result = $students->where('studentid', $row->studentid);
            $data[$key]->student = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
