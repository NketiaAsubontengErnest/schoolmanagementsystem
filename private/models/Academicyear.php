<?php

/**
 * 
 * Academicyear Model
 */
class Academicyear extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'academicyear',
    ];

    protected $beforeInset = [
        'get_year'
    ];

    protected $afterSelect = [
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors 
        if (empty($data['academicyear'])) {
            $this->errors['academicyear'] = "Academic year can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_year($data)
    {
        $data['year'] = date("Y");
        return $data;
    }
}
