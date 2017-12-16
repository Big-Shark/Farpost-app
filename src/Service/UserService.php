<?php

namespace App\Service;

use App\Component\Db;

class UserService {

    private $db;

    function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function registration($password, $email) {

        $time = new \DateTimeImmutable('now', new \DateTimeZone('+0000'));

        $hash = password_hash($this->createSecretString($email, $password, $time), PASSWORD_DEFAULT);
        $code = base64_encode(json_encode(['email' => $email, 'time' => $time->format('U'), 'hash' => $hash]));

        $sql = "INSERT INTO users (password, email, code) VALUES (:password, :email, :code)";
        $result = $this->db->prepare($sql);

        $result->bindParam('email', $email, PDO::PARAM_STR);
        $result->bindParam('password', $password, PDO::PARAM_STR);
        $result->bindParam('code', $code, PDO::PARAM_STR);
        $result->execute();

        $this->sendEmail($email, $code);
    }

    public function login($password, $email) {
        $sql = "SELECT id FROM users WHERE email = :email AND password = :password";
        $result = $this->prepare($sql);

        $result->bindParam('email', $email, PDO::PARAM_STR);
        $result->bindParam('password', $password, PDO::PARAM_STR);
        $result->execute();

        $uid = $result->fetch();

        if ($uid) {
            $_SESSION['user'] = $uid['id'];
            return true;
        }

        return false;
    }

    public function valid($email, $password) {
        $errors = false;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Не корректный Email !!!';
        }

        if (strlen($password) < 3) {
            $errors[] = 'Пароль не может быть меньше трёх символов !!!';
        }

        return $errors;
    }

    public function checkExistUser($email) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $result = $this->db->prepare($sql);

        $result->bindParam('email', $email, PDO::PARAM_STR);
        $result->execute();

        if ($result->fetchColumn()) {
            return false;
        }

        return true;
    }

    public function confirm($code) {
        $sql = "SELECT id FROM users WHERE code = :code";
        $result = $this->db->prepare($sql);

        $result->bindParam('code', $code, PDO::PARAM_STR);
        $result->execute();

        $uid = $result->fetch();

        if ($uid) {
            $_SESSION['user'] = $uid['id'];
            return true;
        }

        return false;
    }

    private function sendEmail($email, $message) {
        $result = mail($email, "Подтверждение", $message, "From: $email");
        return $result;
    }

    private function createSecretString($email, $password, $time) {
        return $email . $password . $time->format('YmdHis');
    }
}