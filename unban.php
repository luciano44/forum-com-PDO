<?php

include './conexao.php';
include './checkban.php';
include './functions.php';

if($_POST['nick'] == ''){
    header('Location: adminsection.php?unbanned-v');
    die();
}

if(nickExists($_POST['nick'])){
    if (checkBan($_POST['nick'])){
        $conn = getConnection();

        $sql = 'UPDATE users SET ban = 0 where nick = ?';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $_POST['nick']);

        if ($stmt->execute()){
            header('Location: adminsection.php?unbanned-s');
        }else{
            header('Location: adminsection.php?unbanned-f');
        }
    }else{
        header('Location: adminsection.php?unbanned-f');
    }
}else {
    header('Location: adminsection.php?unban-user-doesnt-exist');
}