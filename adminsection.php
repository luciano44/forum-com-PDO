<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="header">
        <?php 
        include './includes/header.php';
        ?>

    </div>
<?php
    include 'conexao.php';

            if (isset($_SESSION['admin']))
            {
    ?>  
        <div class='box ban'>
            <h3 style='color: red'>Ban</h3>
            <form action='ban.php' method='post'>
                <input type='text' name='nick' placeholder='nick'>
                <input type='submit' value='Ban'>
            </form>
        <?php
            if(isset($_GET['banned-f'])){
                echo '<p style="color: red;">User já banido.</p>';
            }
            if(isset($_GET['banned-s'])){
                echo '<p style="color: red;">User banido.</p>';
            }
            if(isset($_GET['banned-v'])){
                echo '<p style="color: red;">Campo vazio.</p>';
            }
            if(isset($_GET['ban-user-doesnt-exist'])){
                echo '<p style="color: red;">Usuario não existe.</p>';
            }
        ?>
        </div>
        <div class='box ban'>
            <h3 style='color: red'>Unban</h3>
            <form action='unban.php' method='post'>
                <input type='text' name='nick' placeholder='nick'>
                <input type='submit' value='Unban'>
            </form>
        <?php
            if(isset($_GET['unbanned-f'])){
                echo '<p style="color: red;">User já desbanido.</p>';
            }
            if(isset($_GET['unbanned-s'])){
                echo '<p style="color: red;">User desbanido.</p>';
            }
            if(isset($_GET['unbanned-v'])){
                echo '<p style="color: red;">Campo vazio.</p>';
            }
            if(isset($_GET['unban-user-doesnt-exist'])){
                echo '<p style="color: red;">Usuario não existe.</p>';
            }
        ?>
        </div>

        <box class="box ban">
        
        <h3 style='color: red'>Banned Users</h3>
        <hr style='width: 100%; border: 1px solid #eeeff1;'>
        <?php
            $conn = getConnection();

            $sql = 'SELECT nick FROM users WHERE ban = 1';

            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll();
            foreach($res as $value){
                echo "<p><span style='color:red'>Nickname: </span>".$value['nick']."</p>";
            }
        ?>
        </box>
            <?php
                }
            
            ?>
</body>
</html>