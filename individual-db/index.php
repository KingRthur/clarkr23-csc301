<?php
require_once('dbCl.php');
session_start();
if (!isset($_SESSION['role'])) $_SESSION['role'] = 'null';

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO('mysql:host=localhost;dbname=encounter_generator;charset=utf8mb4','root','',$opt);
$stmt = $pdo->query('SELECT name, id FROM encounter_types');
$type=[];
while ($row = $stmt->fetch()) {
    $type[$row['id']] = $row['name'];
}
?>


    <html lang="en">

    <head>
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
            <?php if (isset($_GET['redir'])){
                    if ($_GET['redir']=='delete') echo '<div class="alert alert-warning" role="alert">
                      Data successfully deleted!
                    </div></br>';
                    elseif ($_GET['redir']=='create') echo '<div class="alert alert-success" role="alert">
                      Data successfully added!
                    </div></br>';
                }
                ?>
            <p class="lead" align="center">
                Select an encounter type below to get started!
            </p>
            <?php
                echo '<center><form action="detail.php" method="GET" id="enc_dropdown_detail"</center>';
                echo '<center><select form="enc_dropdown_detail" name="id" id="id" required></center>';
                foreach($type as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select></center></br>';
                echo '<button type="submit" class="btn btn-primary btn-lg">Begin the encounter!</button>';
                echo '</form>';
                if (!(($_SESSION['role'])=='user' || $_SESSION['role']=='manager' || $_SESSION['role']=='admin')){
                    echo '<p class="lead" align="center">
                        Or <a href="signin.php">Sign In</a> or <a href="signup.php">Sign Up</a> to create and edit encounters.<br/>
                    </p>';
                }
            ?>
            <p class="lead" align="center">
                <?php
                if ($_SESSION['role']=='user'){
                    echo '<center><a class="btn btn-primary btn-lg" href="create.php" role="button" align="center">Create your own!</a></center><br/>';
                    echo 'Or edit an existing encounter by selecting one below:<br/>';
                    $i=0;
                    echo '<center><form action="edit.php" method="GET" id="enc_dropdown_edit"></center>';
                    echo '<center><select form="enc_dropdown_edit" name="id" id="id" required></center>';
                    foreach($type as $key => $value){
                        $table=loadTable($key);
                        if ($table['creator_id']==$_SESSION['user_id']){
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    }
                    echo '</select></center></br>';
                    echo '<button type="submit" class="btn btn-primary btn-lg">Edit Encounter</button>';
                    echo '</form>';
                }
                ?>
                <?php
                if ($_SESSION['role']=='admin' || $_SESSION['role']=='manager'){
                    echo '<center><a class="btn btn-primary btn-lg" href="create.php" role="button" align="center">Create your own!</a></center><br/>';
                    echo 'Or edit an existing encounter by selecting one below:<br/>';
                    $i=0;
                    echo '<center><form action="edit.php" method="GET" id="enc_dropdown_edit"></center>';
                    echo '<center><select form="enc_dropdown_edit" name="id" id="id" required></center>';
                    foreach($type as $key => $value){
                        echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                    echo '</select></center></br>';
                    echo '<button type="submit" class="btn btn-primary btn-lg">Edit Encounter</button>';
                    echo '</form>';
                }
                ?>
                <?php
                if ($_SESSION['role']=='admin' || $_SESSION['role']=='manager'){
                    echo '<p><center><a class="btn btn-primary btn-lg" href="admin.php" role="button" align="center">Admin Portal</a></center><br/></p>';
                }
                if (isset($_SESSION['user_id'])) {
                    echo'</br><a href="signout.php">Sign Out</a>';
                }
                ?>
            </p>
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