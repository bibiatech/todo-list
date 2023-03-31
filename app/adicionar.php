<?php

if(isset($_POST['titulo'])){
    require '../db_conection.php';

    $titulo = $_POST['titulo'];

    if(empty($titulo)){
        header("Location: ../index.php?mess=error");
    }else {
        $stmt = $conn->prepare("INSERT INTO tarefas(titulo) VALUE(?)");
        $res = $stmt->execute([$titulo]);

        if($res){
            header("Location: ../index.php?mess=success"); 
        }else {
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}