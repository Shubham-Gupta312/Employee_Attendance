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

}