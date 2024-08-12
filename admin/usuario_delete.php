<?php 
include "../conn/connect.php";
$conn->query("delete from usuarios where id = ".$_GET['id']);
header("location: usuarios_lista.php");

?>