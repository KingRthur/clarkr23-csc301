<?php
require_once('dbCl.php');

$id=$_GET['id'];
$table=loadTable($id);
$table['likes'] = $table['likes']+1;
$pdo = connectDB();
try{
$pdo->beginTransaction();
$stmt = $pdo->prepare('UPDATE encounter_types SET likes=:likes WHERE id=:id');
$stmt->bindParam(':likes', $table['likes'], PDO::PARAM_INT);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt -> execute(["likes" => $table['likes'], "id" => $id]);
$pdo->commit();
}
catch (Exception $e){
    $pdo->rollback();
    throw $e;
}

?>