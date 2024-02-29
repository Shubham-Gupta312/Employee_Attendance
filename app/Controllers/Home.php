<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('admin/dashboard');
    }
    public function dashboard()
    {
        return view('admin/dashboard');
    }
    public function add_employee()
    {
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $address = $this->request->getPost('address');

        // Slice the first two letters of the name and convert them to uppercase
        $EmpInitials = strtoupper(substr($name, 0, 2));

        // Retrieve the last inserted data from the database
        $employeeModel = new \App\Models\EmployeeModel();
        $lastInsertedEmployee = $employeeModel->orderBy('id', 'DESC')->first();

        if ($lastInsertedEmployee) {
            // Get the employee ID of the last inserted data
            $lastEmployeeId = $lastInsertedEmployee['emp_id'];

            // Extract the numerical part of the last employee ID and increment it
            preg_match('/\d+$/', $lastEmployeeId, $matches);
            $lastEmployeeNumber = (int) $matches[0];
            $newEmployeeNumber = $lastEmployeeNumber + 1;

            // Format the new employee ID with the incremented number
            $employeeId = 'EID' . $EmpInitials . "-" . str_pad($newEmployeeNumber, 4, '0', STR_PAD_LEFT);
        } else {
            // If no data exists, start with employee ID 1
            $employeeId = 'EID' . $EmpInitials . "-" . '0001';
        }

        // Save the new employee details to the database
        $data = [
            'emp_id' => $employeeId,
            'emp_name' => $name,
            'emp_email ' => $email,
            'emp_phone' => $phone,
            'emp_address' => $address,
            'password'    => '',
        ];

        $query = $employeeModel->insert($data);
        // print_r($query);
        if (!$query) {
            $message = ['status' => 'false', 'message' => 'Something went wrong!'];
            return $this->response->setJSON($message);
        } else {
            $message = ['status' => 'true', 'message' => 'Employee Data Add Successfully!!'];
            return $this->response->setJSON($message);
        }
    }

    public function fetch_employee()
    {
        try {
            $fetchData = new \App\Models\EmployeeModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            $searchValue = $_GET['search']['value'];

            // data order in descending order
            $fetchData->orderBy('id', 'DESC');

            // Apply search filter logic
            if (!empty($searchValue)) {
                $fetchData->groupStart();
                $fetchData->like('emp_id', $searchValue);
                $fetchData->orLike('emp_name', $searchValue);
                $fetchData->orLike('emp_email', $searchValue);
                $fetchData->groupEnd();
            }
            // Fetch Employee Data
            $data['emp'] = $fetchData->findAll($length, $start);
            $totalRecords = $fetchData->countAll();
            $associativeArray = [];

            foreach ($data['emp'] as $row) {
                $status = $row['status'];

                // Set button CSS class based on the status
                if ($status == 0) {
                    $buttonCSSClass = 'btn-outline-danger'; // Set button CSS class to red for status value 0
                    $iconClass = 'bi bi-x';
                } elseif ($status == 1) {
                    $buttonCSSClass = 'btn-outline-success'; // Set button CSS class to green for status value 1
                    $iconClass = 'bi bi-check-lg';
                }
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['emp_id'],
                    2 => $row['emp_name'],
                    3 => $row['emp_email'],
                    4 => $row['emp_phone'],
                    5 => $row['emp_address'],
                    6 => '<button class="btn ' . $buttonCSSClass . '" id="active" style="border-radius: 50%;"><i class="bi' . $iconClass . '"></i></button> '
                );
            }

            if (empty($data['emp'])) {
                $output = array(
                    "draw" => intval($draw),
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => [],
                );
            } else {
                $output = array(
                    "draw" => intval($draw),
                    "recordsTotal" => $totalRecords,
                    "recordsFiltered" => $totalRecords,
                    "data" => $associativeArray,
                );
            }

            return $this->response->setJSON($output);
        } catch (\Exception $e) {
            // Log the caught exception
            log_message('error', 'Error in fetch_product: ' . $e->getMessage());

            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function setStatus()
    {
        try {
            $empStatus = new \App\Models\EmployeeModel();
            $id = $this->request->getPost('id');

            // Fetch current Status frob DB
            $currentStatus = $empStatus->getStatus($id);
            // echo $currentStatus;

            $newStatus = ($currentStatus == 0) ? 1 : 0;

            $updateStatus = $empStatus->updateEmpStatus($id, $newStatus);

            if (!$updateStatus) {
                $response = [
                    'status' => 'false',
                    'message' => 'Failed to Update Status!'
                ];
            } else {
                $response = [
                    'status' => 'true',
                    'newStatus' => $newStatus,
                    'message' => 'Status Update Successfully!!'
                ];
            }
            return $this->response->setJSON($response);
        } catch (\Exception $e) {
            // log_message('error', 'Error in setActiveStatus: ' . $e->getMessage());
            return $this->response->setJSON(['error' => 'Internal Server Error']);
        }
    }

    public function resetPassword()
    {
        try {
            $empId = $this->request->getPost('id');
    
            // Fetch the last inserted data from the database
            $employeeModel = new \App\Models\EmployeeModel();
            $data = $employeeModel->find($empId);
    
            // Check if data exists and fetch the email
            if ($data) {
                if ($employeeModel->updateTimestamp($empId)) {
                    $token = $data['emp_id'];
                    $empEmail = $data['emp_email'];
    
                    // Create and send the email
                    $email = \Config\Services::email();
                    $email->setFrom('saxenaaditi525@gmail.com', 'Shubham Gupta');
                    $email->setTo($empEmail);
                    $email->setSubject('Reset Password Link');
                    $message = "Hello,<br><br>Reset Password Link: " . base_url('reset_pswrd') . '?token=' . $token;
                    $email->setMessage($message);
    
                    // Send the email
                    if ($email->send()) {
                        $response = ['status' => 'true', 'message' => 'Reset Password Email sent successfully'];
                    } else {
                        $response = ['status' => 'false', 'message' => 'Reset Password Email failed to send'];
                    }
                } else {
                    $response = ['status' => 'false', 'message' => 'Failed to update timestamp'];
                }
            } else {
                $response = ['status' => 'false', 'message' => 'Employee data not found'];
            }
    
            // Return the JSON response
            return $this->response->setJSON($response);
        } catch (\Exception $e) {
            // Log the exception
            log_message('error', 'Exception in resetPassword: ' . $e->getMessage());
    
            // Return an error response
            return $this->response->setJSON(['status' => 'false', 'message' => 'Internal server error']);
        }
    }
    



    public function reports()
    {
        return view('admin/reports');
    }
}
