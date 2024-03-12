<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'emp_attendance';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getAttendanceByNameAndDate($name, $fromDate, $toDate)
    {
        // Convert date strings to the format used in your database
        $fromDateFormatted = date('Y-m-d', strtotime($fromDate));
        $toDateFormatted = date('Y-m-d', strtotime($toDate));

        $query = $this->select('*')
            ->where('emp_name', $name)
            ->where('date >=', $fromDateFormatted)
            ->where('date <=', $toDateFormatted)
            ->findAll();

        // echo $this->db->getLastQuery(); // Output the last executed query for debugging

        return $query;
    }

    public function getAttendanceByDate($fromDate, $toDate)
    {   
         // Assuming you're using CodeIgniter Query Builder
         return $this->db->table($this->table)
         ->where('date >=', $fromDate)
         ->where('date <=', $toDate)
         ->get()
         ->getResultArray();
 
         // echo $this->db->getLastQuery(); // Output the last executed query for debugging
 
        //  return $query; 
    }

}