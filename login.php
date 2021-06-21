<?php

include './conexao.php';
$conn = getConnection();

$sql = 'SELECT * FROM users where nick = ?';

$stmt = $conn->prepare($sql);

$nick = $_POST['nick'];
$pwd = $_POST['pwd'];

$stmt->bindValue(1, $nick);

$stmt->execute();

$res = $stmt->fetch();

if ($res['ban']){
    header('Location: index.php?ban');
    die();
}else{

$pwdCheck = password_verify($pwd, $res['pwd']);

    if($pwdCheck){
        session_start();
        if($nick == 'admin'){
            $_SESSION['admin'] = $res['name'];
        }
        $_SESSION['name'] = $res['name'];
        $_SESSION['nick'] = $res['nick'];
        header('Location: index.php?login-s');
    }else{
        header('Location: index.php?login-f');
    }
}

