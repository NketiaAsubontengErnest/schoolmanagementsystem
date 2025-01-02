<?php

/**
 * 
 * Fee Model
 */
class Fee extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'classid',
        'numberpresent',
        'numberpaid',
        'schoolfeeghc',
        'schoolfeecfa',
        'classfeeghc',
        'classfeecfa',
        'feedfeeghc',
        'feedfeecfa',
        'numnotpaid',
        'semesterid',
        'credited',
    ];

    protected $beforeInset = [
        'get_semes'
    ];

    protected $afterSelect = [
        'get_class'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors 
        if (empty($data['numberpaid'])) {
            $this->errors['numberpaid'] = "Number paid can't be empty";
        }
        if (empty($data['schoolfeeghc'])) {
            $this->errors['schoolfeeghc'] = "School fee ghc can't be empty";
        }
        if (empty($data['classfeeghc'])) {
            $this->errors['classfeeghc'] = "Class fee ghc can't be empty";
        }
        if (empty($data['feedfeeghc'])) {
            $this->errors['feedfeeghc'] = "Feeding fee ghc can't be empty";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_semes($data)
    {
        $data['semesterid'] = $_SESSION['semester']->id;
        return $data;
    }
    public function get_class($data)
    {
        $class = new Classe();
        foreach ($data as $key => $row) {
            $result = $class->where('id', $row->classid);
            $data[$key]->classes = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
