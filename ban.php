<?php

include './conexao.php';
include './checkban.php';

if($_POST['nick'] == ''){
    header('Location: index.php?banned-v');
    die();
}

if(!checkBan($_POST['nick'])){
    $conn = getConnection();

    $sql = 'UPDATE users SET ban = 1 where nick = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $_POST['nick']);

    if ($stmt->execute()){
        header('Location: index.php?banned-s');
    }else{
        header('Location: index.php?banned-f');
    }
}else{
    header('Location: index.php?banned-f');
}





