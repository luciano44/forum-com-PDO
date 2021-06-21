<?php

include './conexao.php';

$id = $_POST['id'];

$conn = getConnection();

$sql = 'DELETE FROM posts where id = ? LIMIT 1';

$stmt = $conn->prepare($sql);

$stmt->bindValue(1, $id);
if($stmt->execute()){
    header('Location: posts.php?post-deleted');
}else{
    header('Location: posts.php?post-not-deleted');
}
