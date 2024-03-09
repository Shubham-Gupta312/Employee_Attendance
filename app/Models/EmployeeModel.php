<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'emp_data';
    protected $primaryKey = 'id';
    protected $protectFields = [];

    public function getStatus($id)
    {
        // Assume 'status' is the column in your table that stores the status
        $result = $this->select('status')->find($id);

        return $result ? $result['status'] : null;
    }

    public function updateEmpStatus($id, $newStatus)
    {
        // Update the status in the database
        return $this->set(['status' => $newStatus])->where('id', $id)->update();
    }

    public function updateTimestamp($empId)
    {
        // Update only the 'updated_at' timestamp
        try {
            $this->set('updated_at', date('Y-m-d H:i:s'))
                ->where('id', $empId)
                ->update();
            return true; // Return true if update succeeds
        } catch (\Exception $e) {
            // Log the exception
            // log_message('error', 'Exception in updateTimestamp: ' . $e->getMessage());
            return false; // Return false if update fails
        }
    }

    public function getEmpIdByToken($token)
    {
        // Query the database to fetch the employee ID based on the token
        $result = $this->where('emp_id', $token)->first(); // Assuming 'token' is the column name

        if (!empty($result)) {
            return $result['emp_id']; // Assuming 'emp_id' is the column name for the employee ID
        } else {
            return null; // Token not found
        }
    }

    public function updatePassword($id, $data)
    {
        return $this->update($id, $data);
    }


    public function tokenExists($token)
    {
        // Check if the token exists in the database
        $query = $this->where('token', $token)->countAllResults();

        // If count is greater than 0, token exists
        return $query > 0;
    }

    public function updatePasswordByToken($token, $password)
    {
        // Update the token for the employee in the database
        try {
            $this->db->table($this->table)
                ->where('token', $token)
                ->update(['password' => $password]);
            return true;
        } catch (\Exception $e) {
            // Log the exception
            // log_message('error', 'Exception in updateTimestamp: ' . $e->getMessage());
            return false; // Return false if update fails
        }
    }
    public function updateToken($empId, $token)
    {
        // Update the token for the employee in the database
        try {
            $this->db->table($this->table)
                ->where('emp_id', $empId)
                ->update(['token' => $token]);
            return true;
        } catch (\Exception $e) {
            // Log the exception
            // log_message('error', 'Exception in updateTimestamp: ' . $e->getMessage());
            return false; // Return false if update fails
        }
    }

    public function isTokenUsed($token)
    {
        // Check if the token has been used by querying the database
        $query = $this->where('token', $token)
            ->where('is_used', 1) // Assuming 'is_used' is a column indicating whether the token has been used
            ->countAllResults();

        // If count is greater than 0, token has been used
        return $query > 0;
    }

    public function markTokenAsUsed($token)
    {
        try {
            // Mark the token as used in the database
            $this->db->table($this->table)
                ->where('token', $token)
                ->update(['is_used' => 1]); // 1 is indicationg to the column token is used
            return true;
        } catch (\Exception $e) {
            // Log the exception
            // log_message('error', 'Exception in updateTimestamp: ' . $e->getMessage());
            return false; // Return false if update fails
        }
    }

    public function updatePasswordByEmail($email, $password)
    {
        // Update the password for the employee in the database
        try {
            $this->db->table($this->table)
                ->where('emp_email', $email)
                ->update(['password' => $password]);
            return true;
        } catch (\Exception $e) {
            // Log the exception
            // log_message('error', 'Exception in updateTimestamp: ' . $e->getMessage());
            return false; // Return false if update fails
        }
    }

    // Method to retrieve employee details by email
    public function getEmployeeDetailsByEmail($email)
    {
        return $this->select('emp_id, emp_name, emp_email, emp_phone')
            ->where('emp_email', $email)
            ->first();
    }

    public function getLatLongByEmail($email)
    {
        return $this->where('emp_email', $email)->first(); // Assuming you want to fetch the first matching record
    }
}