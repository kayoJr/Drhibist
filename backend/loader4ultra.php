<?php
require './db.php';

$lister = $conn->query("SELECT * FROM `ultraqueue`");
// if ($lister->num_rows > 0) {
    // $results = $lister->fetch_all(MYSQLI_ASSOC);
    $results = mysqli_fetch_assoc($lister);
    // $result = $lister->fetchAll(PDO::FETCH_ASSOC);
    echo "<div class='d-none curr_val'>" . $lister->num_rows . "</div>";
    echo "<table class='table'>";
    echo ' <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Phone</th>
    </tr>
    </thead>';
    echo '<tbody>';
    foreach ($lister as $result) {
        $status = '';
        $cons = '';
        if ($result['status'] == 1) {
            $status = 'flash';
        } else if ($result['status'] == 2){
            $cons = 'consultation';
        }else{
            $status = '';
            $cons = '';
        }
        echo '<tr id="' . $status . '" class="'.$cons.'">
        <th scope="row">' . $result['id'] . '</th>
        <td>' . $result['name'] . '</td>
        <td>' . $result['phone'] . '</td>
        </tr>';
        
    }
    echo '</tbody>';
    echo '</table>';

// }
