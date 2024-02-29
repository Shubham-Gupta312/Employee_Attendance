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

    public function getDataByToken($token)
    {
        // Execute a query to fetch data based on the token
        $query = $this->db->table($this->table)
                          ->where('emp_id', $token)
                          ->get();

        // Check if any rows are returned
        if ($query->getNumRows() > 0) {
            // Return the fetched data
            return $query->getRow();
        } else {
            // No data found for the token
            return null;
        }
    }
}