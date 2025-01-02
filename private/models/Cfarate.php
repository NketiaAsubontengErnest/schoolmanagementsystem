<?php

/**
 * 
 * CFA Model
 */
class Cfarate extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'rateamount',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['rateamount'])) {
            $this->errors['rateamount'] = "Rate amount can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
