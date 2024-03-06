<?php
require 'db.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');
// session_start();
// global $conn;
function sendSms($reg_id, $to)
{
    $message = $reg_id;
    $template_id = 'confirmation_1';

    $server = 'https://sms.yegara.com/api2/send';
    $username = 'drhibistpedriatician';
    $password = ')57r2QkC]1aY]Z!q16WD';

    $postData = array('to' => $to, 'message' => $message, 'template_id' => $template_id, 'password' => $password, 'username' => $username);
    $content = json_encode($postData);
    $curl = curl_init($server);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    $json_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    print_r($json_response);
}
function sendWhatsApp($to, $name, $reg_id)
{

    $params = array(
        'token' => '7braljaybt7ion1c',
        'to' => $to,
        'body' => 'Dear ' . $name . ' You registration number is ' . $reg_id . ' Thank You from Dr. Hibist Pediatrics Specialty Clinic'
    );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.ultramsg.com/instance59159/messages/chat",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => http_build_query($params),
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        //echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
if (isset($_POST['add_pat'])) {
    $name = $_POST['name'];
    $age_num = $_POST['age'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $age_type = $_POST['age_type'];
    $org = @$_POST['org'];
    $payment = @$_POST['payment'];
    $credit = @$_POST['credit'];

    $age = $age_num . ' ' . $age_type;

    $sql = "INSERT INTO `patient`(`name`, `age`, `sex`, `phone`, `org`) 
            VALUES ('$name', '$age', '$sex', $phone, '$org')";
    $res = $conn->query($sql);
    $idd =  mysqli_insert_id($conn);
    if ($res) {
        //  sendWhatsApp($phone, $name, $idd);
        // sendSms($idd, $phone);
        $sql = "INSERT INTO `income` (`price`, `reason`, `pat_id`, `payment`) VALUES (200, 'reception', '$idd', '$payment')";
        if (!$conn->query($sql)) {
            echo $conn->error;
        } else {
            if ($payment == 'Credit') {
                $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (200, 'reception', '$idd', '$credit')";
                $rss = $conn->query($sql);
                if ($rss) {
                    header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
                } else {
                    echo $conn->error;
                }
            } else {
                header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
            }
        }
        // if (isset($_POST['credit'])) {
        //     $credit = $_POST['credit'];
        //     if ($credit == 'cigna') {
        //         echo $idd;
        //         $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (200, 'reception', '$idd', 'cigna')";
        //         $rss = $conn->query($sql);
        //         if ($rss) {
        //             header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
        //         } else {
        //             echo $conn->error;
        //         }
        //     } else if ($credit == 'stc') {
        //         $sql = "INSERT INTO `credit` (`price`, `reason`, `pat_id`, `org`) VALUES (200, 'reception', '$idd', 'stc')";
        //         $rss = $conn->query($sql);
        //         if ($rss) {
        //             header("Location: ../Users/Reception/index.php?msg=Patient Added at &rn=$idd");
        //         } else {
        //             echo $conn->error;
        //         }
        //     }
        // }
    } else {
        header("Location: ../Users/Reception/index.php?err=Patient Not Added");
    }
}
