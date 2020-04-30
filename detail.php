<?php
require_once ('dbCl.php');
session_start();
if (!isset($_SESSION['role'])) $_SESSION['role'] = 'null';

if(!isset($_GET['id'])){
	echo 'Please select an encounter type on the <a href="index.php">index page</a>.';
	die();
}
elseif(isset($_GET['id'])){
    $id=$_GET['id'];
}

$table=loadTable($id);

if($_GET['id']<0 || count($table) < 2){
	echo 'Please select an encounter type on the <a href="index.php">index page</a>.';
	die();
}

?>


    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title><?= $table['name'] ?> Encounters</title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
        function sendLike(enc_id){
           
            // $("#likeButton").click(function(){
            $.ajax({
                type: "GET",
                url: "like.php" ,
                data: { id: enc_id }
            });
        };
        </script>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            <h1 class="display-4" align="center">
                <?= $table['name']." Encounters" ?>
            </h1>
            <?= '<center><img src="'.$table['cover'].'" class="mr-3" alt="Ought to fix this." width="30%"></center>' ?>
            <p class="lead" align="center">
                <br><?= $table['enc_'.rand(1,$table['num_enc'])] ?>
            </p>
            <?= '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$id.'" role="button" align="center">Gimme Another One</a>' ?>
            <?php
            if ($_SESSION['role']!='null'){
                echo '<a class="btn btn-primary btn-lg" id="likeButton" onclick="sendLike('.$id.')" role="button" align="center">"I enjoyed that"</a></center>';
            }
            ?>
            <p>
                <center><a href="index.php">Go back to home page.</a></center>
            </p>
            <hr class="my-4">
            <center><p>Encounters borrowed from <a href="http://www.dndspeak.com">Dndspeak</a>.</p></center>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="http://code.jquery.com/jquery-3.5.0.js"
  integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

    </html>
