<?php
    $rs = $conn->query("SELECT COUNT(id) as unread FROM `nurse_message` WHERE `status` = 0");
    if($rs){
        while($row = $rs->fetch_assoc()){
            $count = $row['unread'];
            if($count == 0){
                $hide = 'hide';
            }else{
                $hide = '';
            }
        }
    }
?>
<ul class="list-unstyled components">
    <li class="active">
        <a href="index.php"><i class="fa-solid fa-address-card"></i>
            <span>Record</span></a>
    </li>
    <li class="active message_counter">
        <a href="messages.php?status=1"><i class="fa-solid fa-message"></i>
            <span>Messages</span> <span class="unread <?php echo $hide; ?>"><?php echo $count; ?></span></a>
    </li>
    <!-- <li class="active message_counter">
        <a href="prescription.php?status=1"><i class="fa-solid fa-prescription"></i>
            <span>Prescription</span></a>
    </li> -->
    <li>
        <a href="../../backend/logout.php"><i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span></a>
    </li>
</ul>
