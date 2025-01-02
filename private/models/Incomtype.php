<?php

/**
 * 
 * Incomtype Model
 */
class Incomtype extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'incomtypename',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['incomtypename'])) {
            $this->errors['incomtypename'] = "Income type can't be empty";
        }
        //check if type exists
        if ($this->where('incomtypename', $data['incomtypename'])) {
            $this->errors['incomtypename'] = "Expenditure type alrady exists";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
