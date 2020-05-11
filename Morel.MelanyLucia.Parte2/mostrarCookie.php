<?php
include_once ("./clases/usuario.php");

$email = isset($_GET['email']) ? $_GET['email'] : NULL;

if ($email != NULL){
    $email= str_replace(".", "_", $email);
    $cookie = isset($_COOKIE[$email]) ? $_COOKIE[$email] : NULL;
    if ($cookie != NULL){
        echo $cookie;
    }
    else{
        echo"No existe cookie con ese email";
    }
}