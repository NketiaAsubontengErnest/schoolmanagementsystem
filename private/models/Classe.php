<?php

/**
 * 
 * Classe Model
 */
class Classe extends Model
{
    protected $ran;
    protected $allowedColumns = [
        'classname',
        'admissionfee',
        'schoolfee',
        'classesfee',
        'examsfee',
    ];

    protected $beforeInset = [];

    protected $afterSelect = [
        'get_total_count',
        'get_atted_overall',
        'get_atted_count',
        'get_examfee_count',
        'get_credited_count',
    ];
    public function validate($data)
    {
        $this->errors = array();
        //checking errors for first name
        if (empty($data['classname'])) {
            $this->errors['classname'] = "Class name can't be empty";
        }
        if (empty($data['admissionfee'])) {
            $this->errors['admissionfee'] = "Admission Fee can't be empty";
        }
        if (empty($data['schoolfee'])) {
            $this->errors['schoolfee'] = "School fee can't be empty";
        }
        if (empty($data['examsfee'])) {
            $this->errors['examsfee'] = "Exams fee can't be empty";
        }
        if (empty($data['classesfee'])) {
            $this->errors['classesfee'] = "Classes fee can't be empty";
        }

        //check if class exists
        if ($this->where('classname', $data['classname'])) {
            $this->errors['classname'] = "Class alrady exists";
        }

        //check if the errors are empty
        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }

    public function get_atted_count($data)
    {
        $attends = new Attendance();
        foreach ($data as $key => $row) {
            $result = $attends->query("SELECT COUNT(CASE WHEN `status` = 'present' THEN 1 END) AS attendance_count, COUNT(CASE WHEN `status` = 'present' THEN 3 END) AS absent_count, SUM(`schoolfee`) AS total_schoolfee, SUM(`classfee`) AS total_classfee, SUM(CASE WHEN credited = 1 THEN `schoolfee` ELSE 0 END) AS total_schoolfee_paid, SUM(CASE WHEN credited = 2 THEN `schoolfee` ELSE 0 END) AS total_schoolfee_unpaid, SUM(CASE WHEN credited = 1 THEN `classfee` ELSE 0 END) AS total_classfee_paid, SUM(CASE WHEN credited = 2 THEN `classfee` ELSE 0 END) AS total_classfee_unpaid, COUNT(CASE WHEN credited = 1 THEN 1 END) AS num_paid, COUNT(CASE WHEN credited = 2 THEN 2 END) AS num_not_paid FROM attendances WHERE classid =  $row->id AND date = CURRENT_DATE; ");
            $data[$key]->attends = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_atted_overall($data)
    {
        $attends = new Attendance();
        foreach ($data as $key => $row) {
            $num = $row->id;
            $result = $attends->query("SELECT SUM(`schoolfee`) AS total_schoolfee, SUM(`classfee`) AS total_classfee, SUM(CASE WHEN credited = 1 THEN `schoolfee` ELSE 0 END) AS total_schoolfee_paid, SUM(CASE WHEN credited = 2 THEN `schoolfee` ELSE 0 END) AS total_schoolfee_unpaid, SUM(CASE WHEN credited = 1 THEN `classfee` ELSE 0 END) AS total_classfee_paid, SUM(CASE WHEN credited = 2 THEN `classfee` ELSE 0 END) AS total_classfee_unpaid, COUNT(CASE WHEN credited = 1 THEN 1 END) AS num_paid, COUNT(CASE WHEN credited = 2 THEN 2 END) AS num_not_paid FROM attendances WHERE attendances.classid =$num");
            
            $data[$key]->totalfees = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
    public function get_credited_count($data)
    {
        $attends = new Attendance();
        foreach ($data as $key => $row) {
            $result = $attends->query("SELECT COUNT(*) AS attendance_count FROM attendances WHERE classid =$row->id  AND date = CURRENT_DATE  AND credited = 1;");
            $data[$key]->credited = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
    public function get_total_count($data)
    {
        $studs = new Student();
        foreach ($data as $key => $row) {
            $result = $studs->selectCountWhere('classid', $row->id );
            $data[$key]->classnum = is_array($result) ? $result[0] : array();
        }
        return $data;
    }

    public function get_examfee_count($data)
    {
        $exams = new Examfee();
       
        foreach ($data as $key => $row) {
            $arr = [
                'semesterid' => isset($_SESSION['semester']->id) ? $_SESSION['semester']->id : '',
                'classid' => $row->id,
            ];
            $result = $exams->query("SELECT SUM(`amount`) AS total_exam_amount FROM `examfees` WHERE `classid`=:classid AND `semesterid`=:semesterid ", $arr);
            $data[$key]->examsfees = is_array($result) ? $result[0] : array();
        }
        return $data;
    }
}
