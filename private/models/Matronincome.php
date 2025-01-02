<?php

/**
 * 
 * Matronincome Model
 */
class Matronincome extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'date',
        'typeid',
        'amount',
    ];

    protected $beforeInset = [
        'get_Sem_Type'
    ];

    protected $afterSelect = [
        'get_Income_Type'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['date'])) {
            $this->errors['date'] = "Select type date";
        }

        if (empty($data['typeid'])) {
            $this->errors['typeid'] = "Select type name";
        }

        if (empty($data['amount'])) {
            $this->errors['amount'] = "Amount can't be empty";
        }        

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    function get_Income_Type($data)
    {
        $exptype = new Matronincometype();
        foreach ($data as $key => $row) {
            $result = $exptype->where('id', $row->typeid);
            $data[$key]->incometype = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_Sem_Type($data)
    {
        $data['semesterid'] = $_SESSION['semester']->id;
        return $data;
    }
}
