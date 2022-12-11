<?php
require_once "db.php";
session_start();
global $conn;

if(isset($_POST['add_user'])){
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $role_temp = $_POST['role'];
    
    if($role_temp == 'admin'){
        $role = 1;
    }else if($role_temp == 'reception'){
        $role = 2;
    }else if($role_temp == 'nurse'){
        $role = 3;
    }else if($role_temp == 'doctor'){
        $role = 4;
    }else if($role_temp == 'laboratory'){
        $role = 5;
    }else if($role_temp == 'ultrasound'){
        $role = 6;
    }else if($role_temp == 'pharmacy'){
        $role = 7;
    }

    $sql = "INSERT INTO `users`(`name`, `phone`, `password`, `role`) 
            VALUES ('$name', '$phone', '$password', $role)";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Admin/addUser.php?msg=User Added");
    }else{
        header("Location: ../Users/Admin/addUser.php?err=User Not Added");
    }
    
}

?>