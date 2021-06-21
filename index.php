
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="device-width, initial-scale=1.0">
    <title>Cadstrar usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class='header'>
<?php
    include './conexao.php';
    include './includes/header.php';
?>
</div>
        <?php
            if (!isset($_SESSION['name']))
            {
        ?>
    <div class='box'>
        <h3>Login</h3>
        <form action='login.php' method='post'>
            <input type='text' name='nick' placeholder='nick'>
            <input type='password' name='pwd' placeholder='password'>
            <input type='submit' value='Submit'>
        </form>
    <?php
        if(isset($_GET['login-s'])){
            echo '<p style="color: green;">Logado</p>';
        }
        if(isset($_GET['login-f'])){
            echo '<p style="color: red;">Usuario ou senha incorretos</p>';
        }
        if(isset($_GET['ban'])){
            echo '<p style="color: red;">Você foi Banido Permanentemente.</p>';
        }
    ?>
    </div>
        <div class='box'>
            <h3>Sign Up</h3>
            <form action='cadastrar.php' method='post'>
                <input type='text' name='nick' placeholder='nick'>
                <input type='text' name='name' placeholder='name'>
                <input type='password' name='pwd' placeholder='password'>
                <input type='submit' value='Submit'>
            </form>
        <?php
            
            if(isset($_GET['success'])){
                echo '<p style="color: green;">Usuario Cadastrado</p>';
            }
            if(isset($_GET['emptynick'])){
                echo '<p style="color: red;">Empty Nick</p>';
            }
            if(isset($_GET['emptyname'])){
                echo '<p style="color: red;">Empty Name</p>';
            }
            if(isset($_GET['emptypwd'])){
                echo '<p style="color: red;">Empty Password</p>';
            }
            if(isset($_GET['error'])){
                echo '<p style="color: red;">Database Error!</p>';
            }
            if(isset($_GET['alreadyexists'])){
                echo '<p style="color: orange;">Nickname already taken!</p>';
            }

        ?>
        </div>
    <?php
            }
    ?>    

<?php
            if (isset($_SESSION['name']))
            {
    ?> 
        <div class="box">
            <h3 style='color: gray'>All Users</h3>
            <hr style='width: 100%; border: 1px solid #eeeff1;'>
            <?php
                $conn = getConnection();

                $sql = 'SELECT * FROM users';

                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll();
                echo "<table border='1' width='450'>
                    <tr>
                        <th>Nickname</th>
                        <th>Name</th>
                        <th>Is Banned</th>
                    </tr> ";
                foreach($res as $value){
                    if($value['ban'] == 1){
                        $banned = "<span style='color:red';>Yes</span>";
                    }else{
                        $banned = "<span style='color:green';>No</span>";
                    }

                    echo " 
                    <tr>
                    <td><a href='profile.php?user=".$value['nick']."'>".$value['nick']."</a></td>
                    <td>".$value['name']."</td>
                    <td>".$banned."</td>
                    </tr> 
                    ";
                }
                echo "</table>";
                ?>
        </div>
    <?php
        }
    ?> 

     

</body>
</html>