<?php
require_once ('dbCl.php');
session_start();
//if (!isset($_SESSION['role'])) $_SESSION['role'] = 'null';
$_SESSION['role'] = 'admin';
if (!isset($_POST['funcType'])){ 
    $_POST['funcType'] = 'null';
}
$id=$_POST['id'];

function modUserType() {
    $pdo = connectDB();
    //If form data is passed, replace data in the DB.
    if(count($_POST)>0){
        //There should probably be some validation that the client hasn't altered the POST array...

        //Create an assoicative array of values to pass to the INSERT.
        $userAtts=[];
        unset($_POST['funcType']);
        foreach($_POST as $key => $value){
            $userAtts[$key] = $value;
        }
        $userAtts['password'] = password_hash($userAtts['password'], PASSWORD_DEFAULT);
        print_r($userAtts);
        try{
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('UPDATE users SET username=:username, password=:password, email=:email, role=:role WHERE id=:id');

        $stmt->bindParam(':username', $userAtts['username'], PDO::PARAM_STR, 20);
        $stmt->bindParam(':password', $userAtts['password'], PDO::PARAM_STR, 255);
        $stmt->bindParam(':email', $userAtts['email'], PDO::PARAM_STR, 50);
        $stmt->bindParam(':role', $userAtts['role'], PDO::PARAM_STR. 20);
        $stmt -> execute($userAtts);
        $pdo->commit();
        //Notify user.
        echo "<p>Data successfully updated!</p>";
        }
        catch (Exception $e){
            $pdo->rollback();
            throw $e;
        }
    }
   
}

function delUserType() {
    //Check if JSON file exists.
    $pdo = connectDB();
    
        //If delete flag is passed, delete the record.
        if($_POST['funcType'] == 'delete'){
            try{
                $pdo->beginTransaction();
                $stmt = $pdo->prepare('DELETE FROM users WHERE id=:id');
                $stmt -> execute(['id' => $_POST['id']]);
                $pdo->commit();
                //Notify user.
                echo "<p>Data successfully deleted!</p>";
                echo '<script type="text/JavaScript">window.location.replace("index.php?redir=delete");</script>'; 
            }
            catch (Exception $e){
                $pdo->rollback();
                throw $e;
            }
        }
}
           
?>


    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>Super Secret Admin Portal</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            
            <h1 class="display-4" align="center">
                <?= "The User Portal" ?>
            </h1>
            <?php
                if ($_SESSION['role']!='admin') echo '<script type="text/JavaScript">window.location.replace("index.php");</script>';
                if ($_POST['funcType'] == 'modify') modUserType();
                elseif ($_POST['funcType'] == 'delete') delUserType();
                
                $opt = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO('mysql:host=localhost;dbname=encounter_generator;charset=utf8mb4','root','',$opt);
                //Query the user table for the specified ID.
                $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
                $stmt->execute([$id]);
                $foo=0;
                //Retrieve column names and create local variables to access them in the PDO array.
                $user=[];
                $row = $stmt->fetch();
                $col_names = array_keys($row);
                foreach ($col_names as $column) {
                    $user[$column] = $row[$column];
                } 
                echo '<form action="edit-user.php" method="POST">
                <input type="hidden" name="funcType" value="modify"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                <br/>
                <center>Username: <input type="text" name="username" value="'.$user['username'].'"></center><br/>
                <center>Password: <input type="password" name="password" value="'.$user['password'].'"></center></br>
                <center>Email: <input type="email" name="email" value="'.$user['email'].'"></center></br>
                <center>Role: <input type="text" name="role" value="'.$user['role'].'"></center></br>';
                echo '<center><button type="sumbit" class="btn btn-primary btn-lg">Submit</button></center>';
                echo '</form>';
                //Delete record.
                echo '<center></br>Or Delete this User altogether!</center>';
                echo '<form action="edit-user.php" method="POST">
                <input type="hidden" name="funcType" value="delete"/>
                <input type="hidden" name="id" value="'.$id.'"/>';
                echo '<center><button type="sumbit" class="btn btn-danger btn-lg" disabled>FK Says No Delete!</button></center>';
                echo '</form>';
            ?>
            <hr class="my-4">
            <p>
                <center><a href="index.php">Go back to home page.</a></center>
            </p>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

    </html>
