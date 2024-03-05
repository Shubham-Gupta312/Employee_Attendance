<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'emp_attendance';
    protected $primaryKey = 'id';
    protected $protectFields = [];
}