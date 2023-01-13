<?php
 
include_once './connection.php';

$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM users";