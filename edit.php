<?php
require('json.php');
$type=readJSON("type.json");
if (isset($_GET['id'])) $id=$_GET['id'];
elseif (isset($_POST['id'])) $id=$_POST['id'];
if (!isset($_POST['funcType'])) $_POST['funcType']='null';
echo '<pre>';
print_r ($_GET);

function modEncType() {
    //Check if JSON file exists. Create an empty version if not.
    if (!file_exists('type.json')){
        $h=fopen('type.json','w+');
        fwrite($h,'');
        fclose($h);
    }
    //If form data is passed, store data in an array.
    if(count($_POST)>0){
        //There should probably be some validation that the client hasn't altered the POST array...
        $index=0;
        $encIndex=0;
        $tempRec=[];
        $tempEnc=[];
        foreach($_POST as $key => $value){
            if ($index<3) ($tempRec[$key] = $value);
            else {$tempEnc[$encIndex] = $value;
                $encIndex++;
            }
            $index++;
        }
        $tempRec['encounters']=$tempEnc;
        echo '<pre>';
        print_r ($tempRec);
        //Write data to JSON db.
        modifyJSON("type.json",$tempRec,$_POST['id']);
        
        //Notify user.
        echo "<p>Data successfully updated!</p>";
    }
   
}

function delEncType() {
    //Check if JSON file exists.
    if (file_exists('type.json')){
    
        //If delete flag is passed, delete the record.
        if($_POST['funcType'] == 'delete'){
            deleteJSON("type.json",$_POST['id']);
            //Notify user.
            echo "<p>Data successfully deleted!</p>";
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
                if (!isset($_POST['id'])) $_POST['id'] = $_GET['id'];
                if (!isset($_GET['id'])) $_GET['id'] = $_POST['id'];
            ?>
            <p class="lead" align="center">
                Enter the info for your encounter table below:
            </p>
            <?php
                $i=0;
                echo '<form action="edit.php" method="POST">
                <input type="hidden" name="funcType" value="modify"/>
                <input type="hidden" name="id" value="'.$_GET['id'].'"/>
                <br/>
                <center>Name of Encounter Set: <input type="text" name="name" value="'.$type[$id]['name'].'"></center><br/>
                <center>Link to Cover Photo: <input type="text" name="pictureLink" value="'.$type[$id]['pictureLink'].'"></center></br>';
                while($i<count($type[$id]['encounters'])){
                    echo '<center>'.($i+1).'.   <input type="text" name="enc'.$i.'" value="'.$type[$id]['encounters'][$i].'" required"/></center><br/>';
                    $i++;
                }
                echo '<center><button type="sumbit">Submit</button></center>';
                echo '</form>';
                //Delete record.
                echo '<center></br>Or Delete this Encounter Altogether!</center>';
                echo '<form action="edit.php" method="POST">
                <input type="hidden" name="funcType" value="delete"/>
                <input type="hidden" name="id" value="'.$_GET['id'].'"/>';
                echo '<center><button type="sumbit">Delete!</button></center>';
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
