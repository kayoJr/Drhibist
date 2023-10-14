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
    $sql = "UPDATE `pat_detail` SET `cc` = '$cc', `dt` = '$dt',
            `sy` = '$sy', `imp`='$imp', `md`='$md', `cn`='$cn',
            `pc`='$pc', `vh`='$vh', `aka`='$aka', `lab`='$lab',
            `dx`='$dx', `rx`='$rx' WHERE `id`= '$id'";
    $res = $conn->query($sql);
    if($res){
        header("Location: ../Users/Doctor/search.php?msg=Done");
    }else{
        header("Location: ../Users/Doctor/search.php?msg=Error");
    }
}

?>