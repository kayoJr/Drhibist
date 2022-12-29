<?php
require 'db.php';
if (isset($_GET['pay_stc'])) {
    $tot = $_GET['tot_pay'];
    $sql = "INSERT INTO `income` (`price`, `reason`) VALUES ('$tot', 'stc')";
    $rs = $conn->query($sql);
    if ($rs) {
        $rss = $conn->query("UPDATE `credit_pharm` SET `status` = 1 WHERE `org` = 'stc'");
        $rss2 = $conn->query("UPDATE `credit` SET `status` = 1 WHERE `org` = 'stc'");
        if (!$rss ) {
            echo $conn->error;
        } else if ($rss && $rss2) {
            $sql = "";
            header('Location: ../Users/Admin?msg=Credit Paid');
        }
    }
} else if (isset($_GET['pay_cigna'])) {
    $tot = $_GET['tot_pay'];
    $sql = "INSERT INTO `income` (`price`, `reason`) VALUES ('$tot', 'cigna')";
    $rs = $conn->query($sql);
    if ($rs) {
        $rss = $conn->query("UPDATE `credit_pharm` SET `status` = 1 WHERE `org` = 'cigna'");
        $rss2 = $conn->query("UPDATE `credit` SET `status` = 1 WHERE `org` = 'cigna'");
        if (!$rss) {
            echo $conn->error;
        } else if($rss && $rss2) {
            $sql = "";
            header('Location: ../Users/Admin?msg=Credit Paid');
        }
    }
} else {
    echo $conn->error;
}
