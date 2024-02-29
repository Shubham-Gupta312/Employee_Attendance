<?php

namespace App\Controllers;

use \App\Libraries\PassHash;

class AuthController extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/register');
        } elseif ($this->request->getMethod() == 'post') {
            // Retrieve form data
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            // Prepare data array
            $value = [
                'name' => $name,
                'email' => $email,
                'password' => PassHash::pass_enc($password)
            ];

            // Instantiate model
            $authModel = new \App\Models\AdminModel();

            try {
                // Attempt to insert data into the database
                $query = $authModel->insert($value);

                if (!$query) {
                    // Database insertion failed
                    $message = ['status' => 'false', 'message' => 'Something went wrong during registration. Please try again.'];
                    return $this->response->setStatusCode(500)->setJSON($message);
                } else {
                    // Database insertion succeeded
                    $message = ['status' => 'true', 'message' => 'Successfully registered.'];
                    return $this->response->setJSON($message);
                }
            } catch (\Exception $e) {
                // Log the exception
                // log_message('error', 'Exception: ' . $e->getMessage());

                // Return error response with specific error message
                $message = ['status' => 'false', 'message' => 'An unexpected error occurred. Please try again later.'];
                return $this->response->setStatusCode(500)->setJSON($message);
            }
        }
    }

    public function login()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/login');
        } elseif ($this->request->getMethod() == 'post') {
            // echo "Login form code here";
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $authLogin = new \App\Models\AdminModel();
            $userData = $authLogin->where('email', $email)->first();

            if (is_null($userData)) {
                $message = ['status' => 'false', 'message' => 'Username/Email Not Found!'];
                return $this->response->setJSON($message);
            }

            $checkPass = PassHash::pass_dec($password, $userData['password']);
            if (!$checkPass) {
                $message = ['status' => 'false', 'message' => 'You Entered wrong Password!'];
                return $this->response->setJSON($message);
            } else {
                if (!is_null($userData)) {
                    $sessionData = [
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'loggedin' => 'loggedin'
                    ];
                    session()->set($sessionData);
                }
                $message = ['status' => 'true', 'message' => 'LoggedIn!'];
                return $this->response->setJSON($message);
            }
        }
    }

    public function logout()
    {
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }

    public function ResetPass($token = null)
    {
        if ($this->request->getMethod() == 'get') {
            $request = \Config\Services::request();
            // Get the full URL including query parameters
            $token = $request->getGet('token');
            // echo $token;    
            $employeeModel = new \App\Models\EmployeeModel();
            // Fetch the employee ID based on the token from the database
            $emp_id = $employeeModel->getEmpIdByToken($token);

            // Check if employee ID is found
            if ($emp_id) {
                // // Debugging statement
                // echo "Token received: " . $token . "<br>";
                // Pass the employee ID value to the view
                $data['emp_id'] = $emp_id;
                // print_r($data);
                return view('auth/reset_pass', $data);
            } else {
                // $message = ['status' => 'false', 'message' => "No employee ID found for the provided token."];
                $message = ['status' => 'false', 'message' => "UnAuthoried Access."];
                return $this->response->setJSON($message);
            }
            // POST REQUEST
        } elseif ($this->request->getMethod() == 'post') {
            $postData = $this->request->getPost();

            // Retrieve the token from the POST data
            if (isset($postData['value'])) {
                $token = $postData['value'];
            } else {
                // Handle the case where the 'value' parameter is not set in the POST data
                // echo "Token not found in POST data.";
                $message = ['status' => 'false', 'message' => 'UnAuthorized Token Access'];
                return $this->response->setJSON($message);
            }

            // Get the password from the POST request
            $password = $this->request->getPost('password');

            $employeeModel = new \App\Models\EmployeeModel();
            $data = $employeeModel->getDataByToken($token);
            if ($data) {
                // Data found for the token
                // echo "Update the password"
                $updateData = ['password' => $password]; // Assuming 'password' is the column name in your database
                $updated = $employeeModel->updatePassword($data->id, $updateData); // Assuming 'id' is the primary key column name

                if ($updated) {
                    // echo "Password updated successfully!";
                    $message = ['status' => 'true', 'message' => "Password updated successfully!!"];
                    return $this->response->setJSON($message);
                } else {
                    // echo "Failed to update password.";
                    $message = ['status' => 'false', 'message' => "Failed to update password.!"];
                    return $this->response->setJSON($message);
                }
                // print_r($data);
            } else {
                // No data found for the token
                // echo "No data found for the token: $token";
                $message = ['status' => 'false', 'message' => "No data found for the token!"];
                return $this->response->setJSON($message);
            }
        }

    }





}
