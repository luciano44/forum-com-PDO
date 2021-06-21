<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
    <?php
        include './includes/header.php';
        include './checkban.php';
    ?>
    </div>
    <div class="box">
        <?php
            if(isset($_GET['user'])){
            $user = $_GET['user'];
            include './conexao.php';
            $conn = getConnection();
            $sql = 'SELECT * FROM users where nick = ?';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $user);
            $stmt->execute();
            $res = $stmt->fetch();

            $nick = $user;

            if(isset($_SESSION['nick'])){
                if($user == $_SESSION['nick']){
                    $nick = "<span style='
                    color: orange;
                    text-shadow: 0 0 3px gold;
                    '>".$user."</span>";
                }
            }
            

            echo "<p>Nick: ".$nick."<br>"
                ."Name: ".$res['name']."<br>"
                ."Ban: ".$res['ban']."</p>";
            }else{
                header('Location: index.php');
            }
            ?>

            
            <h3>Posts: </h3>
            <hr style='width: 100%; margin: 10px 0; border: 1px solid #eeeff1;'>

            <?php
            $conn = getConnection();

            $sql = 'SELECT * FROM posts WHERE author = ? ORDER BY id DESC LIMIT 10';

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(1, $user);
            $stmt->execute();
            $res = $stmt->fetchAll();
            foreach($res as $value){
                $author = htmlspecialchars($value['author'], ENT_QUOTES);
                $title = htmlspecialchars($value['title'], ENT_QUOTES);
                $description = htmlspecialchars($value['description'], ENT_QUOTES);

                if(!checkBan($author)){
                    echo "
                    <div class='box topic'>
                        <span>
                            Author: <a href='profile.php?user=".$author."'>".$author."</a>
                        </span>
                    <br>Title: ".$title."
                    <br>Description: ".$description."<br><br>";
                    
                    if(isset($_SESSION['nick'])){
                        if($_SESSION['nick'] == $author){
                            echo "
                                <form action='deletepost.php' method='POST'>
                                    <input type='hidden' name='page' value='Location: profile.php'>
                                    <input type='hidden' name='user' value=".$user.">
                                    <button type='submit' name='id' value=".$value['id'].">
                                        Delete
                                    </button>
                                </form>
                            ";
                        }
                        echo "</div><br>";}
                    }
                
            }
        ?>


    </div>
</body>
</html>