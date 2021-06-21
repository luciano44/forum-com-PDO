<?php

include './conexao.php';
include './checkban.php';

if($_POST['nick'] == ''){
    header('Location: index.php?unbanned-v');
    die();
}

if (checkBan($_POST['nick'])){
    $conn = getConnection();

    $sql = 'UPDATE users SET ban = 0 where nick = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $_POST['nick']);

    if ($stmt->execute()){
        header('Location: index.php?unbanned-s');
    }else{
        header('Location: index.php?unbanned-f');
    }
}else{
    header('Location: index.php?unbanned-f');
}
