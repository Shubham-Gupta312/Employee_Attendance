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
}