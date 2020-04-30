<?php
require_once('dbCl.php');
session_start();

function addEncType() {
    if(count($_POST)>0){
        //$_SESSION['user_id']=2;//Fuck. Plz remeber to remove this when its fixed.
        //There should probably be some validation that the client hasn't altered the POST array...
    //////////    
        //Calculate the number of non-null encounters entered. And shift them to be adjacent in the order.
        $num_enc=0;
        foreach($_POST as $key => $value){
            if (preg_match('/enc_/', $key) && $value != '') {
                $num_enc++;
                $_POST[$key]=null;
                $_POST['enc_'.$num_enc]=$value;
            }
        }
        
        //Validate the null typing of the null encounters.
        $j = $num_enc;
        while($j<10){
            $j++;
            $_POST['enc_'.$j]=null;
        }

       $pdo = connectDB();
    ///////////
        //Create an assoicative array of values to pass to the INSERT.
        $tableAtts=[];
        foreach($_POST as $key => $value){
            $tableAtts[$key] = $value;
        }
        $tableAtts['num_enc']=$num_enc;
        $tableAtts['creator_id']=$_SESSION['user_id'];
        $tableAtts['date_created']=date("Y-m-d");
        try{
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('INSERT INTO `encounter_types`(`name`, `num_enc`, `cover`, `creator_id`, `date_created`, `enc_1`, `enc_2`, `enc_3`, `enc_4`, `enc_5`, `enc_6`, `enc_7`, `enc_8`, `enc_9`, `enc_10`) VALUES (:name,:num_enc,:cover,:creator_id,:date_created,:enc_1,:enc_2,:enc_3,:enc_4,:enc_5,:enc_6,:enc_7,:enc_8,:enc_9,:enc_10)');

        $stmt->bindParam(':name', $tableAtts['name'], PDO::PARAM_STR, 20);
        $stmt->bindParam(':num_enc', $tableAtts['num_enc'], PDO::PARAM_INT);
        $stmt->bindParam(':cover', $tableAtts['cover'], PDO::PARAM_STR, 140);
        $stmt->bindParam(':creator_id', $tableAtts['creator_id'], PDO::PARAM_INT);
        $stmt->bindParam(':date_created', $tableAtts['date_created'], PDO::PARAM_STR);
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
        }
        catch (Exception $e){
            $pdo->rollback();
            throw $e;
        }
        //Notify user.
        echo "<p>Data successfully updated!</p>";
        echo '<script type="text/JavaScript">window.location.replace("index.php?redir=create");</script>'; 
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
                addEncType();
            ?>
            <p class="lead" align="center">
                Enter the info for your encounter table below:
            </p>
            <?php
                $i=1;
                echo '<form action="create.php" method="POST"><br/>
                <center>Name of Encounter Set: <input type="text" name="name" required></center><br/>
                <center>Link to Cover Photo: <input type="text" name="cover" value="https://picsum.photos/seed/picsum/200/300"></center></br>';
                while($i<11){
                    echo '<center>'.($i).'.   <input type="text" name="enc_'.$i.'"/></center><br/>';
                    $i++;
                }
                echo '<center><button type="sumbit" class="btn btn-primary btn-lg">Submit</button></center>';
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
