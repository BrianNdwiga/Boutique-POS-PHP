
<?php
$db = mysqli_connect('localhost', 'root', '', 'boutique_pos');
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>
<?php

if (isset($_GET['id'])) {

    $result = mysqli_query($db, "DELETE i,o FROM order_items as i INNER JOIN orders as o ON o.order_id = i.order_id WHERE i.order_id = " . $_GET['id']);
    if ($result == true)
        echo "success";
    header("Location:order.php");
}

?>