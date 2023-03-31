<?php
echo $_POST;

if(isset($_POST['id'])){
    echo 'oi';
    require '../db_conection.php';

    $id = $_POST['id'];

    if(empty($id)){
       echo 0;
    }else {
        $stmt = $conn->prepare("DELETE FROM tarefas WHERE id=?");
        $res = $stmt->execute([$id]);

        if($res){
            echo 1;
        }else {
            echo 0;
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}