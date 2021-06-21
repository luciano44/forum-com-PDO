<?php

function checkBan($nick){
    $conn = getConnection();
    $stmt = $conn->prepare('SELECT ban FROM users WHERE nick = ?');

    $stmt->bindValue(1, $nick);
    $stmt->execute();
    $res = $stmt->fetch();

    if ($res['ban']){
        return true;
    }else{
        return false;
    }
}
