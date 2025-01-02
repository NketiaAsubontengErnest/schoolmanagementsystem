<?php

/**
 * 
 * Examfee Model
 */
class Examfee extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'classid',
        'amount',
        'semesterid'
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_Class'
    ];
    public function validate($data)
    {
        $this->errors = array();
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Class($data)
    {
        $classes = new Classe();
        foreach ($data as $key => $row) {
            $result = $classes->where('id', $row->classid);
            $data[$key]->class = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Sem_Type($data)
    {
        $semester = new Semester();
        $data['semid'] = $semester->selctingLastId()[0]->id;
        return $data;
    }
}
