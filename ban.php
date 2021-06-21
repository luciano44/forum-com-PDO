<?php

include './conexao.php';
include './checkban.php';
include './functions.php';

if($_POST['nick'] == ''){
    header('Location: adminsection.php?banned-v');
    die();
}

if(nickExists($_POST['nick'])){
    if(!checkBan($_POST['nick'])){
        $conn = getConnection();

        $sql = 'UPDATE users SET ban = 1 where nick = ?';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $_POST['nick']);

        if ($stmt->execute()){
            header('Location: adminsection.php?banned-s');
        }else{
            header('Location: adminsection.php?banned-f');
        }
    }else{
        header('Location: adminsection.php?banned-f');
    }
}else{
    header('Location: adminsection.php?ban-user-doesnt-exist');
}





