<?php
    require '../backend/db.php';

    $sql = $conn->query("SELECT * FROM `meds` WHERE `amount` <= 10 ORDER BY `amount` ASC");
while ($row = $sql->fetch_assoc()) {
    $name = $row['name'];
    $amount = $row['amount'];

    $body = "You have only " . $amount . " " . $name . " in pharmacy";
    $results[] = $body;
}
$all_results = implode("\n", $results);
sendWhatsApp($all_results);

function sendWhatsApp($name)
{

        // echo "<h1>You have only $amount in pharmacy</h1>";
        $params = array(
        'token' => '7braljaybt7ion1c',
        'to' => '+251913722716',
        'body' => $name
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
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
    }


?>