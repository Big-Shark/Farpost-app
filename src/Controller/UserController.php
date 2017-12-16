<?php

namespace App\Controller;

use App\Component\View;
use App\Service\UserService;

class UserController {

    private $view;
    private $userService;

    public function __construct(View $view, UserService $userService) {
        $this->view = $view;
        $this->userService = $userService;
    }

    public function actionIndex() {
        return $this->view->render('user/main');
    }

    public function actionConfirm() {
        $error = false;

        if (isset($_SESSION['user'])) {
            header('Location: /user/image');
            return;
        }

        if (isset($_POST['submit'])) {
            $code = $_POST['code'];

            if (!$this->userService->confirm($code)) {
                $error = 'Не верный КОД !!!';
            } else {
                header('Location: /user/image');
                return;
            }
        }

        return $this->view->render('user/confirm');
    }

    public function actionRegistration() {
        $errors = false;

        if (isset($_SESSION['user'])) {
            header('Location: /user/image');
            return;
        }

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = $this->userService->valid($email, $password);

            if ($errors == false) {
                $this->userService->registration($password, $email);
                header('Location: /user/confirm');
            }
        }

        return $this->view->render('user/registration');
    }

    public function actionLogin() {
        $errors = false;

        if (isset($_SESSION['user'])) {
            header('Location: /user/image');
            return;
        }

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = $this->userService->valid($email, $password);

            if (!$this->userService->checkExistUser($email)) {
                $errors[] = 'Email или пароль существует !!!';
            }

            if (!$this->userService->login($password, $email)) {
                $errors[] = "Не верный логин или пароль !!!";
            } else {
                header('Location: /user/image');
                return;
            }
        }

        return $this->view->render('user/login');
    }

    public function actionLogout() {
        unset($_SESSION['user']);
        header('Location: /user/login');
        return;
    }
}