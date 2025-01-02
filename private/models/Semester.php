<?php

/**
 * 
 * Semester Model
 */
class Semester extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'semester',
        'academyearid',
        'reportdate',
        'nextdate',
        'numofdays',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_Academ_Type'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors 
        if (empty($data['semester'])) {
            $this->errors['semester'] = "Semester can't be empty";
        }
        if (empty($data['academyearid'])) {
            $this->errors['academyearid'] = "Semester can't be empty";
        }
        if (empty($data['reportdate'])) {
            $this->errors['reportdate'] = "Report date can't be empty";
        }
        if (empty($data['nextdate'])) {
            $this->errors['nextdate'] = "Next date can't be empty";
        }
        if (empty($data['numofdays'])) {
            $this->errors['numofdays'] = "number of days can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Academ_Type($data)
    {
        $acadedm = new Academicyear();
        foreach ($data as $key => $row) {
            $result = $acadedm->where('id', $row->academyearid);
            $data[$key]->academics = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
