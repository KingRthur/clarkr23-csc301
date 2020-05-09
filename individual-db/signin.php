<?php
require_once ('dbCl.php');

function signin(){
    $emailCheck = 'false';
    $passCheck = 'false';
    if(count($_POST)>0){
        $pdo = connectDB();

        //Validate email
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) return('The email you entered is not valid.');
        $_POST['email']=strtolower($_POST['email']);

        //Validate password
        $_POST['password']=trim($_POST['password']);
        if(strlen($_POST['password']) < 8) return('The password must be at least 8 characters.');

        
        //Fetch account details by email
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $numMatched = $stmt->rowCount();
        if($numMatched > 0){
            //Verify password from account
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST['password'],$row['password'])){
                session_start();
                $_SESSION['user_id']=$row['id'];
                $_SESSION['role']=$row['role'];
                echo '<script type="text/JavaScript">window.location.replace("index.php?redir=account-created");</script>';
            }
            else echo '<div class="alert alert-danger" role="alert">
                Incorrect password. Please try again.
            </div>';
        }
        else echo '<div class="alert alert-warning" role="alert">
                      That email has not been registered. Please register an account.
                    </div></br>';
        
    }
}
?>

<html lang="en">

    <head>
        <?php 
        if(count($_POST)>0){
            $error=signin();
            if(isset($error[0])) echo $error;
        }
        ?>
        
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <base href="./" target="_self">
        <title>Encounter Generator</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            
            <h1 class="display-4" align="center">
                Encounter Generator
            </h1>
            <p class="lead" align="center">
                Sign in to create and edit encounter tables!
            </p>
            
            <center>
            <form action="signin.php" method="POST">
                Sign in to your account:<br />
                Email
                <input type="email" name="email" required /><br />
                Password
                <input type="password" name="password" required minlength=8 required/><br />
                <button type="submit">Sign into account</button>
            </form>
            <p>
                <center><a href="index.php">Go back to home page.</a></center>
            </p>
            </center>
            
            <hr class="my-4">
            <center><p>Some encounters borrowed from <a href="http://www.dndspeak.com" target="_blank">Dndspeak</a>.</p></center>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

    </html>