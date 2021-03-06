<?php
require_once ('dbCl.php');
session_start();
if (!isset($_SESSION['role'])) $_SESSION['role'] = 'null';
if (!isset($_POST['funcType'])) $_POST['funcType'] = 'null';
$id=$_POST['id'];

function modEncType() {
    $pdo = connectDB();
    //If form data is passed, replace data in the DB.
    if(count($_POST)>0){ 
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
        $stmt = $pdo->prepare('UPDATE encounter_types SET name=:name, num_enc=:num_enc, cover=:cover, date_created=:date_created, last_modified=:last_modified, creator_id=:creator_id, enc_1=:enc_1, enc_2=:enc_2, enc_3=:enc_3, enc_4=:enc_4, enc_5=:enc_5, enc_6=:enc_6, enc_7=:enc_7, enc_8=:enc_8, enc_9=:enc_9, enc_10=:enc_10 WHERE id=:id');

        $stmt->bindParam(':name', $tableAtts['name'], PDO::PARAM_STR, 20);
        $stmt->bindParam(':num_enc', $tableAtts['num_enc'], PDO::PARAM_INT);
        $stmt->bindParam(':cover', $tableAtts['cover'], PDO::PARAM_STR, 140);
        $stmt->bindParam(':date_created', $tableAtts['date_created'], PDO::PARAM_STR);
        $stmt->bindParam(':last_modified', $tableAtts['last_modified'], PDO::PARAM_STR);
        $stmt->bindParam(':creator_id', $tableAtts['creator_id'], PDO::PARAM_INT);
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
        <base href="./" target="_self">
        <title>Super Secret Admin Portal</title>
    </head>

    <body>
        <div class="jumbotron">
            <!doctype html>
            
            <h1 class="display-4" align="center">
                <?= "The Encounter Portal" ?>
            </h1>
            <?php
                if ($_SESSION['role']!='admin' && $_SESSION['role']!='manager') echo '<script type="text/JavaScript">window.location.replace("index.php");</script>';
                if ($_POST['funcType'] == 'modify') modEncType();
                elseif ($_POST['funcType'] == 'delete') delEncType();
                
                $opt = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $table=loadTable($id);
                $table['date_created'] = str_replace(' ', 'T', $table['date_created']);
                $table['last_modified'] = str_replace(' ', 'T', $table['last_modified']);
                echo '<form action="edit-enc-admin.php" method="POST">
                <input type="hidden" name="funcType" value="modify"/>
                <input type="hidden" name="id" value="'.$id.'"/>
                <br/>
                <center>Name of Encounter Set: <input type="text" name="name" value="'.$table['name'].'"></center><br/>
                <center>Link to Cover Photo: <input type="text" name="cover" value="'.$table['cover'].'"></center></br>
                <center>Date Created: <input type="datetime-local" name="date_created" value="'.$table['date_created'].'"></center></br>
                <center>Last Modified: <input type="datetime-local" name="last_modified" value="'.$table['last_modified'].'"></center></br>
                <center>Creator ID: <input type="number" name="creator_id" value="'.$table['creator_id'].'"></center></br>'
                    ;
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
