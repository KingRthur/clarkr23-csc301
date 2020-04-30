<?php
require_once ('dbCl.php');
session_start();
//if (!isset($_SESSION['role'])) $_SESSION['role'] = 'null';
$_SESSION['role'] = 'admin';
$_POST['funcType'] = 'null';
           
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
                <?= "The Portal" ?>
            </h1>
            <?php
                if ($_SESSION['role']!='admin') echo '<script type="text/JavaScript">window.location.replace("index.php");</script>';
                if ($_POST['funcType'] == 'modify') modEncType();
                elseif ($_POST['funcType'] == 'delete') delEncType();
                
                $opt = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $pdo = new PDO('mysql:host=localhost;dbname=encounter_generator;charset=utf8mb4','root','',$opt);
                //Pull users from DB.
                $usr = $pdo->query('SELECT * FROM users');
                $users=[];
                while ($row = $usr->fetch()) {
                    $users[$row['id']] = $row['username'];
                }
                //Pull encounter tables from DB.
                $enctype = $pdo->query('SELECT * FROM encounter_types');
                $types=[];
                while ($row = $enctype->fetch()) {
                    $types[$row['id']] = $row['name'];
                }
            ?>
            <p class="lead" align="center">
                Select a user account to edit:
            </p>
            <?php
                echo '<center><form action="edit-user.php" method="POST" id="user_dropdown_admin"</center>';
                echo '<input type="hidden" name="funcType" value="modify-user"/>';
                echo '<center><select form="user_dropdown_admin" name="id" id="id" required></center>';
                foreach($users as $key => $value){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select></center></br>';
                echo '<button type="submit" class="btn btn-primary btn-lg">Edit user</button>';
                echo '</form>';   
            ?>
            <p class="lead" align="center">
                Select a user account to edit:
            </p>
            <?php
                echo '<center><form action="edit-enc-admin.php" method="POST" id="enc_dropdown_admin"</center>';
                echo '<input type="hidden" name="funcType" value="modify-enc"/>';
                echo '<center><select form="enc_dropdown_admin" name="id" id="id" required></center>';
                foreach($types as $key => $value){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select></center></br>';
                echo '<button type="submit" class="btn btn-primary btn-lg">Edit encounter</button>';
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
