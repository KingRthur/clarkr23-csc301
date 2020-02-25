<?php
require('json.php');

function addEncType() {
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
            if ($index<2) ($tempRec[$key] = $value);
            else {$tempEnc[$encIndex] = $value;
                $encIndex++;
            }
            $index++;
        }
        $tempRec['encounters']=$tempEnc;
        echo '<pre>';
        print_r ($tempRec);
        //Write data to JSON db.
        $input = readJSON('type.json');
        $input[count($input)] = $tempRec;
        writeJSON("type.json",$input);
        //Notify user.
        echo "<p>Data successfully updated!</p>";
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
                $i=0;
                echo '<form action="create.php" method="POST"><br/>
                <center>Name of Encounter Set: <input type="text" name="name"></center><br/>
                <center>Link to Cover Photo: <input type="text" name="pictureLink" value="https://picsum.photos/seed/picsum/200/300"></center></br>';
                while($i<10){
                    echo '<center>'.($i+1).'.   <input type="text" name="enc'.$i.' required"/></center><br/>';
                    $i++;
                }
                echo '<center><button type="sumbit">Submit</button></center>';
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
