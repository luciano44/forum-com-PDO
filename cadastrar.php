<?php

include './conexao.php';
include './functions.php';

$conn = getConnection();

$sql = 'INSERT INTO users (nick, name, pwd) VALUES (?,?,?)';
$stmt = $conn->prepare($sql);

$nick = $_POST['nick'];
$name = $_POST['name'];
$pwd = $_POST['pwd'];
$pwd = password_hash($pwd, PASSWORD_DEFAULT);

if($_POST['nick'] == ''){
    header('Location: index.php?emptynick=1');
    die();
}
if($_POST['name'] == ''){
    header('Location: index.php?emptyname=1');
    die();
}
if($_POST['pwd'] == ''){
    header('Location: index.php?emptypwd=1');
    die();
}
if(nickExists($_POST['nick'])){
    header('Location: index.php?alreadyexists');
    die();
}

$stmt->bindValue(1, $nick);
$stmt->bindValue(2, $name);
$stmt->bindValue(3, $pwd);

if($stmt->execute()){
    header('Location: index.php?success=1');
}else{
    header('Location: index.php?error=1');
}

