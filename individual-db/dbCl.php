<?php
  

function connectDB(){
     $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO('mysql:host=localhost;dbname=encounter_generator;charset=utf8mb4','root','',$opt);
    return $pdo;
}

function loadTable($tableID){
    $id=$tableID;
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO('mysql:host=localhost;dbname=encounter_generator;charset=utf8mb4','root','',$opt);
    //Query the encounter table for the specified ID.
    $stmt = $pdo->prepare('SELECT * FROM encounter_types WHERE id = ?');
    $stmt->execute([$id]);
    //Retrieve column names and create local variables to access them in the PDO array.
    $table=[];
    $row = $stmt->fetch();
    $col_names = array_keys($row);
    foreach ($col_names as $column) {
        $table[$column] = $row[$column];
    } 
    return $table;
} 

    
?>