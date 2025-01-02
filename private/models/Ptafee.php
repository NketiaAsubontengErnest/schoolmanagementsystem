<?php

/**
 * 
 * Ptafee Model
 */
class Ptafee extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'studentid',
        'semesterid',
        'recieptnum',
        'amount',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_Studnet'
    ];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['studentid'])) {            
            $this->errors['studentid'] = "Select Student, ";
        }
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Enter Amount ";
        }
        if (empty($data['recieptnum'])) {
            $this->errors['recieptnum'] = "Reciept nummber can't be empty";
        }
        //check if class exists
        if ($this->query('SELECT * FROM `ptafees` WHERE `studentid` =' . $_POST['studentid'] . ' AND `semesterid` =' . $_POST['semesterid'])) {
            $this->errors['studentid'] = "Student Alrady Paid";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Studnet($data)
    {
        $students = new Student();
        foreach ($data as $key => $row) {
            $result = $students->where('studentid', $row->studentid);
            $data[$key]->student = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
