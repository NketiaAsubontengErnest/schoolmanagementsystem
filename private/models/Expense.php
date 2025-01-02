<?php

/**
 * 
 * Expense Model
 */
class Expense extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'typeid',
        'amount',
        'discription',
        'date',
    ];

    protected $beforeInset = [
        'get_Sem_Type'
    ];

    protected $afterSelect = [
        'get_Expens_Type'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['typeid'])) {
            $this->errors['typeid'] = "Select a type";
        }
        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount can't be empty";
        }
        if (empty($data['discription'])) {
            $this->errors['discription'] = "Discription can't be empty";
        }
        if (empty($data['date'])) {
            $this->errors['date'] = "Date can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_Expens_Type($data)
    {
        $exptype = new Expentype();
        foreach ($data as $key => $row) {
            $result = $exptype->where('id', $row->typeid);
            $data[$key]->expetype = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Sem_Type($data)
    {
        $data['semid'] = $_SESSION['semester']->id;
        return $data;
    }
}
