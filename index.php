<?php
$email="rclark.437.j@gmail.com";
$bio="Select an encounter type below to get started!";
require('json.php');
$type=readJSON("type.json");
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
                <?= "Encounter Generator" ?>
            </h1>
            <p class="lead" align="center">
                <?= $bio."<br/>"; ?>
            </p>
            <?php
                $i=0;
                echo '<center><form action="detail.php" method="GET" id="enc_dropdown_detail"</center>';
                echo '<center><select form="enc_dropdown_detail" name="id" id="id" required></center>';
                while(isset($type[$i])){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$i.'">'.$type[$i]['name'].'</option>';
                    $i++;
                }
                echo '</select></center></br>';
                echo '<button type="submit">Begin the encounter!</button>';
                echo '</form>';
            ?>
            <p class="lead" align="center">
                Or<br/>
                <center><a class="btn btn-primary btn-lg" href="create.php" role="button" align="center">Create your own!</a></center><br/>
            </p>
            <p class="lead" align="center">
                Or edit an existing encounter by selecting one below:<br/>
                <?php
                $i=0;
                echo '<center><form action="edit.php" method="GET" id="enc_dropdown_edit"></center>';
                echo '<center><select form="enc_dropdown_edit" name="id" id="id" required></center>';
                while(isset($type[$i])){
                    /*echo '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$i.'" role="button" align="center">'.$type[$i]['name'].'</a></center><br/>';*/
                    echo '<option value="'.$i.'">'.$type[$i]['name'].'</option>';
                    $i++;
                }
                echo '</select></center></br>';
                echo '<button type="submit">Edit Encounter</button>';
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
