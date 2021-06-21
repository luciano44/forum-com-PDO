<?php

session_start();
include './conexao.php';

$conn = getConnection();

$sql = 'INSERT INTO posts (author, title, description) VALUES (?,?,?)';

$author = $_SESSION['nick'];
$title = $_POST['title'];
$description = $_POST['description'];

if($_POST['title'] == ''){
    header('Location: posts.php?no-title');
    die();
}
if($_POST['description'] == ''){
    header('Location: posts.php?no-description');
    die();
}

$stmt = $conn->prepare($sql);
$stmt->bindValue(1, $author);
$stmt->bindValue(2, $title);
$stmt->bindValue(3, $description);

if ($stmt->execute()){
    header('Location: posts.php?post-s');
}else{
    header('Location: posts.php?post-f');
}