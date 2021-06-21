<?php
session_start();

if(isset($_SESSION['name'])){
    echo "
        <form action='logout.php' method='post'>
        <button type='submit'>Logout</button>
        </form>

        <a href='index.php'>Users</a> 
        <a href='posts.php'>Posts</a>
    
        <p> 
        <a href='profile.php?user=".$_SESSION['nick']."'>".$_SESSION['nick']."</a>
        </p>
    ";
}else{
    echo "
        <a href='index.php'>Main</a> 
        <a href='posts.php'>Posts</a>
        <p>
        <span style='color: gray;'> log in to use the website.</span>
        </p>
    ";
}


    if (isset($_SESSION['admin']))
    {
        echo "<a style='color:red;' href='adminsection.php'>Admin Section</a>";
    }
 
