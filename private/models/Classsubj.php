<?php

/**
 * 
 * Classsubj Model
 */
class Classsubj extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'classid',
        'subjid',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_Subject'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['subjid'])) {
            $this->errors['subjid'] = "Select subject";
        }
        //check if class exists
        if ($this->query('SELECT * FROM `classsubjs` WHERE `classid` =:classid AND `subjid` =:subjid', $data)) {
            $this->errors['subjid'] = "Subject alrady asigned to class";
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
