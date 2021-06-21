<?php
    include './conexao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <?php
        include './includes/header.php';
        ?>
    </div>
    <?php
        if(isset($_SESSION['nick'])){
    ?>
        
    <div class="box">
        <h3>Create Topic</h3>
        <form action="sendpost.php" method="post">
            <input type="text" name="title" placeholder="title">
            <input type="text" name="description" placeholder="description">
            <input type="submit" value="Send">
        </form>
        <?php
            if(isset($_GET['post-s'])){
                echo 'Enviado';
            }
            if(isset($_GET['post-f'])){
                echo 'Falha ao enviar';
            }
            if(isset($_GET['no-title'])){
                echo 'Insert a title';
            }
            if(isset($_GET['no-description'])){
                echo 'Insert a Description';
            }
        ?>
    </div>
    <?php
        }
    ?>
    <div class="box">
        <?php
            $conn = getConnection();

            $sql = 'SELECT * FROM posts ORDER BY id DESC LIMIT 30';

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll();
            foreach($res as $value){
                $author = htmlspecialchars($value['author'], ENT_QUOTES);
                $title = htmlspecialchars($value['title'], ENT_QUOTES);
                $description = htmlspecialchars($value['description'], ENT_QUOTES);
                echo "
                <div class='box topic'>
                    <span>
                        Author: <a href='profile.php?user=".$author."'>".$author."</a>
                    </span>
                <br>Title: ".$title."
                <br>Description: ".$description."

                </div><br>
                ";
            }
        ?>

    </div>
    

</body>
</html>