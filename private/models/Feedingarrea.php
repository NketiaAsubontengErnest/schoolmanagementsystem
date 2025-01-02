<?php

/**
 * 
 * Feedingarrea Model
 */
class Feedingarrea extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'date',
        'studentnum',
        'amount',
        'classid',
        'status',
    ];

    protected $beforeInset = [
        'get_Sem_Type'
    ];

    protected $afterSelect = [
        'get_Student'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['date'])) {
            $this->errors['date'] = "Select type date";
        }

        if (empty($data['studentnum'])) {
            $this->errors['studentnum'] = "Select student name";
        }

        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount can't be empty";
        }        

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    function get_Student($data)
    {
        $students = new Student();
        foreach ($data as $key => $row) {
            $result = $students->where('studentid', $row->studentnum);
            $data[$key]->student = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Sem_Type($data)
    {
        $data['semesterid'] = $_SESSION['semester']->id;
        return $data;
    }
}
