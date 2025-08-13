<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();

            $data = [
                'name'     => $this->request->getVar('name'),
                'email'    => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
            ];

            $userModel->save($data);

            return redirect()->to('/login');
        }

        return view('auth/register');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $userModel = new UserModel();
            $session = session();

            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = $userModel->where('email', $email)->first();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $sessionData = [
                        'user_id'  => $user['id'],
                        'name'     => $user['name'],
                        'email'    => $user['email'],
                        'logged_in' => true,
                    ];
                    $session->set($sessionData);
                    return redirect()->to('/dashboard');
                }
            }

            $session->setFlashdata('msg', 'Wrong password.');
            return redirect()->to('/login');
        }

        return view('auth/login');
    }

    public function forgotPassword()
    {
        // Logic for forgot password goes here
        // This would typically involve sending a password reset link to the user's email.
        // For this example, we'll just show a view.
        return view('auth/forgot_password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
