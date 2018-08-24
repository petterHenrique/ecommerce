<?php
$bool = $_SESSION["logado"];
if($bool != 1){
	session_destroy();
	header("Location: ".base_url()."index.php/login");
}
?>