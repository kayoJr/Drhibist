<?php
require './db.php';

// $id = $_GET['rn'];
// $num = $_GET['quant'];
// if(isset($_POST['submit'])){
//     $id = $_POST['name'];
//     $price = $_POST['books'];
//     $doc = $_POST['doc'];
//     $pat = $_POST['pat'];
//     $sql = "INSERT INTO `lab_cart`(`name`, `price`, `patient_id`, `doctor_id`) VALUES ('$id', '$price', '$pat', '$doc')";
//     $rs = $conn->query($sql);
//     if(!$rs){
//         echo $conn->error;
//     }else{
//         header("Location:../Users/Doctor/index.php?search=$pat&searching=Search");
//     }
// }


  
$checkbox1 = $_POST['chkl'] ; 

 if(isset($_POST['submit'])){  
     $pat = $_POST['pat'];
    
     foreach ($checkbox1 as $ch){
          //echo "$ch";
         $sqlc="SELECT * FROM `laboratory` WHERE `name`= '$ch' ";
        $rss5 = $conn->query($sqlc);
        
      // while($r=$rss5->fetch_assoc())
        //{
                // $name=$r['name'];
                // $pat=$_POST['pat'];
                // $doc=$_POST['doc'];
                // $price=$r['price'];

                $sql = "INSERT INTO `lab_cart`(`name`, `price`, `patient_id`) VALUES ('$ch', '100', '$pat')";
                    $rs = $conn->query($sql);
                    if(!$rs){
                        echo $conn->error;
                    }else{
                        header("Location:../Users/Doctor/index.php?search=$pat&searching=Search");
                    }
        //}
        }
 }elseif(isset($_POST['submitus'])){
     
 }



        // } else{
        //     echo "miki";
        //     echo mysql_error();}
?>  
