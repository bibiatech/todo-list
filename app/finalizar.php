<?php

if(isset($_POST['id'])){
    require '../db_conection.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 'error';
    }else {
        $tarefas = $conn->prepare("SELECT id, finalizado FROM tarefas WHERE id=?");
        $tarefas->execute([$id]);

        $tarefa = $tarefas->fetch();
        $uId = $tarefa['id'];
        $finalizar = $tarefa['finalizado'];

        $ufinalizar = $finalizar ? 0 : 1;

        $res = $conn->query("UPDATE tarefas SET finalizado=$ufinalizar WHERE id=$uId");

        if($res){
            echo $finalizar;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}