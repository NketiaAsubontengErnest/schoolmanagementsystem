<?php

/**
 * 
 * Matronexpendtype Model
 */
class Matronexpendtype extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'typename',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['typename'])) {
            $this->errors['typename'] = "Expenditure type can't be empty";
        }
        //check if type exists
        if ($this->where('typename', $data['typename'])) {
            $this->errors['typename'] = "Expenditure type alrady exists";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
