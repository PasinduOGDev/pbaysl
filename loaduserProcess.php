<?php

include "connection.php";

$rs = Database::search("SELECT * FROM `user` WHERE `user_type_id`='2'");
$num = $rs->num_rows;

for ($x = 0; $x < $num; $x++) {
    $data = $rs->fetch_assoc();

    ?>

    <tr>        
        <td scope="col"><?php echo $data["fname"]; ?></td>
        <td scope="col"><?php echo $data["lname"]; ?></td>
        <td scope="col"><?php echo $data["email"]; ?></td>
        <td scope="col"><?php echo $data["mobile"]; ?></td>
        <td scope="col"><?php
        if ($data["status_status_id"] == 1) {
            echo ("Active");
        } else {
            echo ("Deactive");
        }
        ?></td>
    </tr>

    <?php

}

?>