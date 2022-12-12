<?php
require 'db.php';
if(isset($_POST['submit'])){
    $id = $_POST['pat_id'];
    $cc = $_POST['cc'];
    $dt = $_POST['dt'];
    $sy = $_POST['sy'];
    $imp = $_POST['imp'];
    $md = $_POST['md'];
    $cn = $_POST['cn'];
    $pc = $_POST['pc'];
    $vh = $_POST['vh'];
    $aka = $_POST['aka'];
    $lab = $_POST['lab'];
    $dx = $_POST['dx'];
    $rx = $_POST['rx'];
    $sql = "INSERT INTO `pat_detail`(`pat_id`, `cc`, `dt`, `sy`, `imp`, `md`, `cn`, `pc`, `vh`, `aka`, `lab`, `dx`, `rx`) 
            VALUES ('$id','$cc',
            '$dt', '$sy', '$imp', 
            '$md', '$cn', '$pc', 
            '$vh', '$aka', '$lab', 
            '$dx', '$rx')";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Doctor/index.php?msg=Done&search=$id&searching=Search");
    }else{
        header("Location: ../Users/Doctor/index.php?msg=Error&search=$id&searching=Search");
    }
}

?>