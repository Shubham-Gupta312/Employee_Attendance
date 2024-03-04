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
}
