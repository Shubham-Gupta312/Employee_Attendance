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

    // public function ResetPass()
    // {
    //     if ($this->request->getMethod() == 'get') {
    //         return view('auth/reset_pass');
    //     }elseif($this->request->getMethod() == 'post'){
    //         $password = $this->request->getPost('password');

    //         $value = [
    //             'password' => $password
    //         ];

    //         $resetPass = new \App\Models\EmployeeModel();
    //         $query = $resetPass->insert($value);

    //         if(!$query){
    //             echo "fail";
    //         }
    //         else{
    //             echo "success";
    //         }
    //     }
    // }

    // public function ResetPass($token=null)
    // {
    //     if ($this->request->getMethod() == 'get') {
    //         return view('auth/reset_pass');
    //     } elseif ($this->request->getMethod() == 'post') {
    //         if(!empty($token)){
    //             $VerifyModel = new \App\Models\EmployeeModel();
    //             $userData = $VerifyModel->verifyToken($token);
    //             if(!empty($userData)){

    //             }else{
    //                 echo "NO user found";
    //             }
    //         }else{
    //             echo 'Unauthorized Access token unavailable';
    //         }
    //     }
    // }
    public function ResetPass()
{
    if ($this->request->getMethod() == 'get') {
        return view('auth/reset_pass');
    } elseif ($this->request->getMethod() == 'post') {
        // Fetch the token from the URL segment
        $token = $this->request->uri->getSegment(3); // Assuming the token is in the third segment of the URL
        
        if (!empty($token)) {
            // Here, you can verify the token and update the password in the database
            // Your verification and password update code goes here
            echo "Token: " . $token; // For testing purposes, you can just echo the token
            exit(); // This will stop execution and display the token. Remove it once you have identified the issue.
        } else {
            // Token not found in the URL
            echo "Token not provided";
            exit(); // This will stop execution and display the error message. Remove it once you have identified the issue.
        }
    }
}




}
