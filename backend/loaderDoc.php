<?php
require './db.php';

$lister = $conn->query("SELECT * FROM `queue`");
if ($lister->num_rows > 0) {
    $results = $lister->fetch_all(MYSQLI_ASSOC);
    echo "<div class='d-none curr_val'>" . $lister->num_rows . "</div>";
    echo "<table class='table'>";
    echo ' <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Patient ID</th>
        <th scope="col">Action</th>
    </tr>
    </thead>';
    echo '<tbody>';
    // $num = 1;
    foreach ($results as $result) {
        $id = $result['id'];
        $name = $result['name'];
        echo '<tr>
        <th scope="row">'. $result['id']. '</th>
        <td>'. $result['name']. '</td>
        <td>'. $result['patient_id']. '</td>
        <td> 
        <button type="button" class="btn btn-primary my-0" 
        onclick="doctor(\''. $result['id']. '\')">Call</button>
        <button type="button" class="btn btn-primary my-0" 
        onclick="stopQueue(\''. $result['id']. '\')">Stop</button>
        <button type="button" class="btn-danger btn my-0" 
        onclick="delQueue(\''. $result['id']. '\')">Done</button>
        </td>
    </tr>';
    // $num++;
    }
    echo '</tbody>';
    echo '</table>';
}
