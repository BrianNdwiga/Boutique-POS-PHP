
<?php
$db = mysqli_connect('localhost', 'root', '', 'boutique_pos');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
<?php

if (isset($_GET['id']))
{

$result = mysqli_query($db,"DELETE FROM orders WHERE id=".$_GET['id']);
if($result==true)
	echo "sucess";
header("Location:order.php");
}

?>