<?php
$email="rclark.437.j@gmail.com";
session_start();
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

        <title>Encounter Generator</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            
            <h1 class="display-4" align="center">
                Encounter Generator
            </h1>
            <?php if (isset($_GET['redir'])){
                    if ($_GET['redir']=='delete') echo '<p>Data successfully deleted!</p></br>';
                    elseif ($_GET['redir']=='create') echo '<p>Data successfully added!</p></br>';
                }
                ?>
            <p class="lead" align="center">
                Select an encounter type below to get started!
            </p>
            <?php
                echo '<center><form action="detail.php" method="GET" id="enc_dropdown_detail"</center>';
                echo '<center><select form="enc_dropdown_detail" name="id" id="id" required></center>';
                foreach($type as $key => $value){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select></center></br>';
                echo '<button type="submit" class="btn btn-primary btn-lg">Begin the encounter!</button>';
                echo '</form>';
            ?>
            <p class="lead" align="center">
                Or <a href="signin.php">Sign In</a> or <a href="signup.php">Sign Up</a> to create and edit encounters.<br/>
                <center><a class="btn btn-primary btn-lg" href="create.php" role="button" align="center">Create your own!</a></center><br/>
            </p>
            <p class="lead" align="center">
                Or edit an existing encounter by selecting one below:<br/>
                <?php
                $i=0;
                echo '<center><form action="edit.php" method="GET" id="enc_dropdown_edit"></center>';
                echo '<center><select form="enc_dropdown_edit" name="id" id="id" required></center>';
                foreach($type as $key => $value){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
                echo '</select></center></br>';
                echo '<button type="submit" class="btn btn-primary btn-lg">Edit Encounter</button>';
                echo '</form>';
            ?>
            </p>
            <hr class="my-4">
            <center><p>Some encounters borrowed from <a href="http://www.dndspeak.com">Dndspeak</a>.</p></center>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

    </html>
