<?php

function nickExists($nick){

    $conn = getConnection();

    $sql = 'SELECT * FROM users where nick = ?';

    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $nick);
    $stmt->execute();
    $res = $stmt->fetchAll();
    if($res){
        return true;
    }else{
        return false;
    }
}



