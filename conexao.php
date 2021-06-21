<?php

function getConnection(){

    $dsn = 'mysql:host=localhost;dbname=cadastrouser;charset=utf8';
    $name = 'root';
    $pwd = '';

    try {
        $pdo = new PDO($dsn, $name, $pwd);
        
        return $pdo;
    } catch (PDOException $e) {
        echo 'Erro: '.$e->getMessage();
    }
}