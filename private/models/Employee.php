<?php

/**
 * 
 * User Model
 */
class Employee extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'gh_id',
        'nationality',
        'health_ins_id',
        'spouse_name',
        'spouse_phone',
        'job_titil',
        'basic_salary',
        'status',
        'assignclass',
        'weeklyallowance',
        'ssnitamount',
        'foodalloance'
    ];

    protected $beforeInset = [
        'make_staff_id'
    ];

    protected $afterSelect = [
        'get_class_assigned'
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['first_name'])) {
            $this->errors['first_name'] = "First name can't be empty";
        }
        if (empty($data['first_name']) || !preg_match('/^[a-z A-Z-]+$/', $data['first_name'])) {
            $this->errors['first_name'] = "Only letters allowed in first name";
        }
        if (empty($data['last_name'])) {
            $this->errors['last_name'] = "First name can't be empty";
        }
        if (empty($data['last_name']) || !preg_match('/^[a-z A-Z-]+$/', $data['last_name'])) {
            $this->errors['last_name'] = "Only letters allowed in Last name";
        }
        if (empty($data['phone'])) {
            $this->errors['phone'] = "Phone can't be empty";
        }
        if (strlen($data['phone']) < 10) {
            $this->errors['phone'] = "Phone can't be less than 15";
        }
        //check if type exists
        if ($this->where('phone', $data['phone'])) {
            $this->errors['phone'] = "Phone number alrady exists";
        }
        if (empty($data['address'])) {
            $this->errors['address'] = "Address can't be empty";
        }
        if (empty($data['gender'])) {
            $this->errors['gender'] = "Please select the gender";
        }
        if (empty($data['nationality'])) {
            $this->errors['nationality'] = "Please select the nationality";
        }
        if (empty($data['gh_id'])) {
            $this->errors['gh_id'] = "National ID can't be empty";
        }
        //check if type exists
        if ($this->where('gh_id', $data['gh_id'])) {
            $this->errors['gh_id'] = "National ID number alrady exists";
        }
        if (strlen($data['gh_id']) < 15) {
            $this->errors['gh_id'] = "Ghana card number can't be < 15";
        }
        if (empty($data['job_titil'])) {
            $this->errors['job_titil'] = "Please select the Job Titil";
        }
        if (empty($data['basic_salary'])) {
            $this->errors['basic_salary'] = "Basic Salary can't be empty";
        }
        if (empty($data['status'])) {
            $this->errors['status'] = "Employment Type can't be empty";
        }
        if (empty($data['weeklyallowance'])) {
            $this->errors['weeklyallowance'] = "Weekly allowance can't be empty";
        }
        if (empty($data['foodalloance'])) {
            $this->errors['foodalloance'] = "Food allowance can't be empty";
        }
        //check if type exists
        if(!empty($data['health_ins_id'])){
            if ($this->where('health_ins_id', $data['health_ins_id'])) {
                $this->errors['health_ins_id'] = "Health Insurance number alrady exists";
            }
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function make_staff_id($data)
    {
        $ids = $this->selctingId()[0]->staffid;

        $ids = substr($ids, 3);

        $ids++;
        if ($ids < 10) {
            $ids = "000" . $ids;
        } elseif ($ids < 100) {
            $ids = "00" . $ids;
        } elseif ($ids < 1000) {
            $ids = "0S" . $ids;
        }

        $data['staffid'] = "EMA" . $ids;
        return $data;
    }

    public function get_class_assigned($data)
    {
        $classe = new Classe();
        foreach ($data as $key => $row) {
            $result = $classe->where('id', $row->assignclass);
            $data[$key]->clsses = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
