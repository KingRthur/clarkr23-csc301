<?php
$email="rclark.437.j@gmail.com";
$bio="Select an encounter type below to get started!";
require ('json.php');
$type=readJSON("type.json");

if(!isset($_GET['id'])){
	echo 'Please enter the id of a member or visit the <a href="index.php">index page</a>.';
	die();
}
if($_GET['id']<0 || $_GET['id']>count($type)-1){
	echo 'Please select an encounter type on the <a href="index.php">index page</a>.';
	die();
}
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $title=$type[$id]['name'];
}
?>


    <html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title><?= $title ?> Encounters</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            <h1 class="display-4" align="center">
                <?= $title." Encounters" ?>
            </h1>
            <?= '<center><img src="'.$type[$id]['pictureLink'].'" class="mr-3" alt="Ought to fix this." width="30%"></center>' ?>
            <p class="lead" align="center">
                <br><?= $type[$id]['encounters'][rand(0,99)] ?>
            </p>
            <?= '<center><a class="btn btn-primary btn-lg" href="detail.php?id='.$id.'" role="button" align="center">Gimme Another One</a></center>' ?>
            <p>
                <center><a href="index.php">Go back to home page.</a></center>
            </p>
            <hr class="my-4">
            <center><p>Encounters borrowed from <a href="http://www.dndspeak.com">Dndspeak</a>.</p></center>

        </div>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>

    </html>
