<?php

namespace App\Controllers;

use \App\Libraries\PassHash;

class UserController extends BaseController
{

    public function UserLogin()
    {
        if ($this->request->getMethod() == 'get') {
            return view('userLogin');
        } elseif ($this->request->getMethod() == "post") {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new \App\Models\EmployeeModel();
            $userData = $userModel->where('emp_email', $email)->first();

            if (is_null($userData)) {
                $message = ['status' => 'false', 'message' => 'Email not found'];
                return $this->response->setJSON($message);
            }

            // Validate password
            $checkPassword = PassHash::pass_dec($password, $userData['password']);
            if (!$checkPassword) {
                $message = ['status' => 'false', 'message' => 'Incorrect password'];
                return $this->response->setJSON($message);
            } else {
                if ($userData['status'] == 1) {
                    // User is logged in, perform action to logged in the user account
                    if (!is_null($userData)) {
                        $sessionData = [
                            'name' => $userData['emp_name'],
                            'email' => $userData['emp_email'],
                            'loggedin' => 'loggedin'
                        ];
                        session()->set($sessionData);
                    }
                    // Authentication successful
                    $message = ['status' => 'true', 'message' => 'Logged in successfully'];
                    return $this->response->setJSON($message);
                } else {
                    // User is not authorized, show a message
                    $message = ['status' => 'false', 'message' => 'You are not authorized to log in.'];
                    return $this->response->setJSON($message);
                }
            }
        }
    }

    public function signout()
    {
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function userResetEmail()
    {
        if ($this->request->getMethod() == 'get') {
            return view('userResetEmail');
        } elseif ($this->request->getMethod() == 'post') {
            // echo "Check email is valid or not";
            $email = $this->request->getPost('email');

            $checkModel = new \App\Models\EmployeeModel();
            // Check if the email exists in the database
            $emailExists = $checkModel->where('emp_email', $email)->countAllResults() > 0;

            if ($emailExists) {
                // Email exists in the database, set it in the session
                session()->set('reset_email', $email);
                // Email exists in the database
                $message = ['status' => 'true', 'message' => 'Email exists'];
            } else {
                // Email does not exist in the database
                $message = ['status' => 'false', 'message' => 'Email does not exist'];
            }

            return $this->response->setJSON($message);

        }
    }
    public function userResetPass()
    {
        if ($this->request->getMethod() == 'get') {
            return view('userResetpass');
        } elseif ($this->request->getMethod() == 'post') {
            // echo " Reset Password work here";
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // encrypt password
            $encryptPassword = PassHash::pass_enc($password);
            $resetModel = new \App\Models\EmployeeModel();
            // Update the password based on the provided email
            $updated = $resetModel->updatePasswordByEmail($email, $encryptPassword);

            if ($updated) {
                // Password updated successfully
                $message = ['status' => 'true', 'message' => 'Password updated successfully!'];
            } else {
                // Failed to update password
                $message = ['status' => 'false', 'message' => 'Failed to update password!'];
            }

            return $this->response->setJSON($message);

        }
    }

    public function getEmpDetails()
    {
        $email = $this->request->getPost('email');
        // Load the EmployeeModel
        $employeeModel = new \App\Models\EmployeeModel();

        // Call the method to retrieve employee details by email
        $employeeDetails = $employeeModel->getEmployeeDetailsByEmail($email);

        if ($employeeDetails !== null) {
            $message = ['status' => 'true', 'message' => $employeeDetails];
        } else {
            $message = ['status' => 'false', 'message' => 'Employee details not found'];
        }

        // Return the details as JSON
        return $this->response->setJSON($message);
    }

    public function mark_attendance()
    {
        $id = $this->request->getPost('id');
        $kgid = $this->request->getPost('kgid');
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $phone = $this->request->getPost('phone');
        $date = $this->request->getPost('date');
        $time = $this->request->getPost('time');
        $city = $this->request->getPost('address');
        $latitude = $this->request->getPost('latitude');
        $longitude = $this->request->getPost('longitude');

        $data = [
            'emp_id' => $id,
            'kgid' => $kgid,
            'emp_name' => $name,
            'emp_email' => $email,
            'emp_phone' => $phone,
            'date' => date('Y-m-d'),
            'time' => $time,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'city' => $city
        ];

        $emp_attendance = new \App\Models\UserModel();
        $mark_attendance = $emp_attendance->insert($data);
        // Insert data into the database
        if ($mark_attendance) {
            $message = ['status' => 'success', 'message' => 'Attendance marked successfully'];
        } else {
            $message = ['status' => 'error', 'message' => 'Failed to mark attendance'];
        }

        // Return the response as JSON
        return $this->response->setJSON($message);
    }

    public function getSessionEmail()
    {
        $sessionEmail = session()->get('email');
        $location = new \App\Models\EmployeeModel();
        $latLong = $location->getLatLongByEmail($sessionEmail);
        // return $this->response->setJSON(['email' => $sessionEmail]);
        if ($latLong) {
            // If latLong is not null, prepare the response with email, latitude, and longitude
            return $this->response->setJSON([
                'email' => $sessionEmail,
                'latitude' => $latLong['latitude'],
                'longitude' => $latLong['longitude']
            ]);
        } else {
            // If latLong is null, return only the email
            return $this->response->setJSON(['email' => $sessionEmail]);
        }
    }


    public function fetchEmployeeDetails()
    {
        try {
            $fetchData = new \App\Models\UserModel();

            $draw = $_GET['draw'];
            $start = $_GET['start'];
            $length = $_GET['length'];
            // $searchValue = $_GET['search']['value'];

            // Retrieve email from session
            $sessionEmail = session()->get('email');

            // data order in descending order
            $fetchData->orderBy('id', 'DESC');

            // // Apply search filter logic
            // if (!empty($searchValue)) {
            //     $fetchData->groupStart();
            //     $fetchData->like('date', $searchValue);
            //     $fetchData->orLike('city', $searchValue);
            //     $fetchData->orLike('emp_email', $searchValue);
            //     $fetchData->groupEnd();
            // }

            // Apply filter to fetch data for the logged-in user only
            $fetchData->where('emp_email', $sessionEmail);
            // Fetch Employee Data
            $data['details'] = $fetchData->findAll($length, $start);
            $totalRecords = $fetchData->countAll();
            $associativeArray = [];

            foreach ($data['details'] as $row) {

                // $associativeArray[] = array(
                //     0 => $row['id'],
                //     1 => $row['emp_id'],
                //     2 => $row['emp_name'],
                //     3 => $row['emp_phone'],
                //     4 => $row['emp_email'],
                //     5 => $row['date'],
                //     6 => $row['time'],
                //     7 => $row['latitude'],
                //     8 => $row['longitude'],
                //     9 => $row['city'],
                // );
                $associativeArray[] = array(
                    0 => $row['id'],
                    1 => $row['kgid'],
                    2 => $row['emp_name'],
                    3 => $row['date'],
                    4 => $row['time'],
                );
            }

            if (empty($data['details'])) {
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


}
