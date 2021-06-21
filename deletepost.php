<?php

include './conexao.php';
 
$page = $_POST['page'];
$id = $_POST['id'];

$conn = getConnection();

$sql = 'DELETE FROM posts where id = ? LIMIT 1';

$stmt = $conn->prepare($sql);

$stmt->bindValue(1, $id);
if($stmt->execute()){
    if(isset($_POST['user'])){
        header($page.'?user='.$_POST['user'].'&?post-deleted');
        die();
    }
    header($page.'?post-deleted');
}else{
    if(isset($_POST['user'])){
        header($page.'?user='.$_POST['user'].'&?post-not-deleted');
        die();
    }
    header($page.'?post-not-deleted');
}
