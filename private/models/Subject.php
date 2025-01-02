<?php

/**
 * 
 * Subject Model
 */
class Subject extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'title',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['title'])) {
            $this->errors['title'] = "Subject can't be empty";
        }
        //check if type exists
        if ($this->where('title', strtoupper($data['title']))) {
            $this->errors['title'] = "Subject alrady exists";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }
}
