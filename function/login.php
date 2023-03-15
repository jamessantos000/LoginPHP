<?php

if(!isset($_POST["submit"])){
    exit();
}

require_once '../config/mysql.php';

$user = $_POST['email'];
$validateEmail = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

$passwdUser = $_POST['passwd'];

if (preg_match($validateEmail, $user)) {
    $email = $user;
  } else {
    echo "O endereço de e-mail é inválido!";
    exit();
}

$conn = mysqli_connect($host, $username, $passwd, $dbname);

if(!$conn){
    die("Erro, tente novamente mais tarde.");
    exit();
}

$verifyUser = $conn->query("SELECT pass FROM users WHERE login = '$email'");
$crypt = $verifyUser->fetch_row();
$crypt2 = $crypt[0];

if(password_verify($passwdUser, $crypt2)){
    echo "Validação OK";
}else{
    echo "Usuário ou senha incorreto";
}