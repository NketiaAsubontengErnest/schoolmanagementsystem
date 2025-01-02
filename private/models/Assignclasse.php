<?php

/**
 * 
 * Assignclasse Model
 */
class Assignclasse extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'studentnumber',
        'classid',
        'userid',
        'semesterid',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];

    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['studentnumber'])) {
            $this->errors['studentnumber'] = "Select Student";
        }
        //check if class exists
        if ($this->query('SELECT * FROM `attendances` WHERE `studentnumber` =' . $_POST['studentnumber'] . ' AND `date` =' . date('Y-m-d'))) {
            $this->errors['subjid'] = "Attendance alrady taken for student";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
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
}
