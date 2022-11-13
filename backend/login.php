<?php
/* A PHP code that is used to login a user. */
require_once "db.php";
session_start();
global $conn;
if(isset($_POST['login'])){
    $phone = $_POST['phone'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM `users` WHERE `phone`='$phone' AND `password`='$password'";
    $result = $conn->query($sql);

/* Checking if the user is an admin or not. */
    if($result -> num_rows > 0 ){
        $_SESSION['user'] = $phone;
        $sql = "SELECT `role` FROM `users` WHERE `phone`='$phone'";
        $res = $conn->query($sql);
        if($res){
            while($stat = mysqli_fetch_assoc($res)){
                $state = $stat['role'];
                if($state == 1){
                    header("Location: ../Users/Admin");
                }else if($state == 2){
                    header("Location: ../Users/Reception");
                }else if($state == 3){
                    header("Location: ../Users/Nurse");
                }else if($state == 4){
                    header("Location: ../Users/Doctor");
                }else if($state == 5){
                    header("Location: ../Users/Laboratory");
                }else if($state == 6){
                    header("Location: ../Users/Ultrasound");
                }else if($state == 7){
                    header("Location: ../Users/Pharmacy");
                }else{
                    header("Location: ../index.php?msg=Your account is blocked");
                }
            }
        }else{
            echo "error";
        }
    }else{
        header("Location: ../index.php?msg=username or password is incorrect");
        echo 'pass incorrect';
    }
}

?>