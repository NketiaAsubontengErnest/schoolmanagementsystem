<?php

/**
 * 
 * Expentype Model
 */
class Expentype extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'expntype',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['expntype'])) {
            $this->errors['expntype'] = "Expnditure type can't be empty";
        }
        //check if type exists
        if ($this->where('expntype', $data['expntype'])) {
            $this->errors['expntype'] = "Expenditure type alrady exists";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
