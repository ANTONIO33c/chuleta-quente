<?php 
include "../conn/connect.php";
$conn->query("delete from tipos where id = ".$_GET['id']);
header("location: tipos_lista.php");

?>