<?php

/**
 * 
 * User Model
 */
class User extends Model
{
   protected $ran;
   protected $allowedColumns = [
      'password',
      'staffid',
      'rank',
      'active'
   ];

   protected $beforeInset = [
      'hash_password',
   ];

   protected $afterSelect = [
      'get_Emplyee',
   ];
   public function validate($data)
   {
      $this->errors = array();
      //checking errors for first name

      if (count($this->errors) == 0) {
         return true;
      }
      return false;
   }

   public function hash_password($data)
   {
      $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
      return $data;
   }

   public function get_Emplyee($data)
   {
      $empl = new Employee();
      foreach ($data as $key => $row) {
         if (!empty($row->id)) {
            $result = $empl->where('staffid', $row->staffid);
            $data[$key]->staff = is_array($result) ? $result[0] : array();
         }
      }
      return $data;
   }

   public function checkretypepass($data)
   {
      $this->errors = array();
      if (empty($data['password']) || empty($data['retyppassword'])) {
         $this->errors['password'] = "Passwords cant be empty!";
      } elseif ($data['password'] != $data['retyppassword']) {
         $this->errors['password'] = "Passwords missmatch!";
      } elseif (strlen($data['password']) < 8) {
         $this->errors['password'] = "Passwords length should not be < 8";
      } else {
         unset($data['retyppassword']);
         return $this->hash_password($data);
      }
      return false;
   }

}
