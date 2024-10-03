<?php
require "Database.php";
class User extends Database {
    public function register($first_name, $last_name, $username, $password) {
        $sql = "INSERT INTO users (first_name, last_name, username, password)
                VALUES ('$first_name', '$last_name', '$username', '$password')";

        if ($this->conn->query($sql)) {
            header("location: ../views/");
            exit;
        } else {
            die("Error in Registering: " . $this->conn->error);
        }
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = '$username'";
    
        $result = $this->conn->query($sql);
    
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
    
            if (password_verify($password, $user['password'])) {
                session_start();
    
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
    
                header("location: ../views/dashboard.php");
                exit;
            } else {
                die("Your Password is incorrect");
            }
        } else {
            die("Username not found");
        }
    }
}
