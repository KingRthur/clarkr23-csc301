<?php
require_once ('dbCl.php');
session_start();

if (isset($_GET['id'])) $id=$_GET['id'];
elseif (isset($_POST['id'])) $id=$_POST['id'];
if (!isset($_POST['id'])) $_POST['id'] = $_GET['id'];
if (!isset($_GET['id'])) $_GET['id'] = $_POST['id'];
if (!isset($_POST['funcType'])) $_POST['funcType']='null';

function modEncType() {
    $pdo = connectDB();
    //If form data is passed, replace data in the DB.
    if(count($_POST)>0){
        //There should probably be some validation that the client hasn't altered the POST array...
            
        //Calculate the number of non-null encounters entered. And shift them to be adjacent in the order.
        $num_enc=0;
        foreach($_POST as $key => $value){
            if (preg_match('/enc_/', $key) && $value != '') {
                $num_enc++;
            }
        }

        //Create an assoicative array of values to pass to the INSERT.
        $tableAtts=[];
        unset($_POST['funcType']);
        foreach($_POST as $key => $value){
            $tableAtts[$key] = $value;
        }
        $tableAtts['num_enc']=$num_enc;
        try{
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('UPDATE encounter_types SET name=:name, num_enc=:num_enc, cover=:cover, enc_1=:enc_1, enc_2=:enc_2, enc_3=:enc_3, enc_4=:enc_4, enc_5=:enc_5, enc_6=:enc_6, enc_7=:enc_7, enc_8=:enc_8, enc_9=:enc_9, enc_10=:enc_10 WHERE id=:id');

        $stmt->bindParam(':name', $tableAtts['name'], PDO::PARAM_STR, 20);
        $stmt->bindParam(':num_enc', $tableAtts['num_enc'], PDO::PARAM_INT);
        $stmt->bindParam(':cover', $tableAtts['cover'], PDO::PARAM_STR, 140);
        $x=1;
        while($x <= $tableAtts['num_enc']){
            if (is_null($tableAtts['enc_'.$x])){
                $stmt->bindParam(':enc_'.$x, $tableAtts['enc_'.$x], PDO::PARAM_NULL);
            }
            else{
               $stmt->bindParam(':enc_'.$x, $tableAtts['enc_'.$x], PDO::PARAM_STR, 200); 
            }
            $x++;
        }
        $stmt -> execute($tableAtts);
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

function delEncType() {
    //Check if JSON file exists.
    $pdo = connectDB();
    
        //If delete flag is passed, delete the record.
        if($_POST['funcType'] == 'delete'){
            try{
                $pdo->beginTransaction();
                $stmt = $pdo->prepare('DELETE FROM encounter_types WHERE id=:id');
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

        <title>Encounter Generator</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            
            <h1 class="display-4" align="center">
                <?= "Encounter Generator" ?>
            </h1>
            <?php
                if ($_POST['funcType'] == 'modify') modEncType();
                elseif ($_POST['funcType'] == 'delete') delEncType();
                $table=loadTable($id);
            ?>
            <p class="lead" align="center">
                Enter the info for your encounter table below:
            </p>
            <?php
                echo '<form action="edit.php" method="POST">
                <input type="hidden" name="funcType" value="modify"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                <br/>
                <center>Name of Encounter Set: <input type="text" name="name" value="'.$table['name'].'"></center><br/>
                <center>Link to Cover Photo: <input type="text" name="cover" value="'.$table['cover'].'"></center></br>';
                $i=1;
                while($i<11){
                    echo '<center>'.($i).'.   <input type="text" name="enc_'.$i.'" value="'.$table['enc_'.$i].'"/></center><br/>';
                    $i++;
                }
                echo '<center><button type="sumbit" class="btn btn-primary btn-lg">Submit</button></center>';
                echo '</form>';
                //Delete record.
                echo '<center></br>Or Delete this Encounter Altogether!</center>';
                echo '<form action="edit.php" method="POST">
                <input type="hidden" name="funcType" value="delete"/>
                <input type="hidden" name="id" value="'.$id.'"/>';
                echo '<center><button type="sumbit" class="btn btn-danger btn-lg">Delete!</button></center>';
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
