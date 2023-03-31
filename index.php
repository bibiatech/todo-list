<?php 
require 'db_conection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Minhas tarefas</title>
</head>
<body>
    <div class="main-section">
       <div class="add-section">
          <form action="app/adicionar.php" method="POST" autocomplete="off">
             <?php if(isset($_GET['mess']) && $_GET['mess'] == 'error'){ ?>
                <input type="text" name="titulo" style="border-color: #ff6666" placeholder="Esse campo é obrigatório" />
              <button type="submit">+Adicionar<button>

             <?php }else{ ?>
              <input type="text" name="titulo" placeholder="Qual sua tarefa?" />
              <button type="submit">+Adicionar</button>
             <?php } ?>
          </form>
       </div>
       <?php 
          $tarefas = $conn->query("SELECT * FROM tarefas ORDER BY id DESC");
       ?>
       <div class="show-todo-section">
            <?php if($tarefas->rowCount() <= 0){ ?>
                <div class="todo-item">
                    <div class="empty">
                        <img src="img/339255-PALBC4-591.jpg" width="100%" />
                        <img src="img/Ellipsis.gif" width="80px">
                    </div>
                </div>
            <?php } ?>

            <?php while($tarefa = $tarefas->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="todo-item">
                    <span id="<?php echo $tarefa['id']; ?>" class="remove-to-do">x</span>
                    <?php if($tarefa['finalizado']){ ?> 
                        <input type="checkbox"
                               class="check-box"
                               data-todo-id ="<?php echo $tarefa['id']; ?>"
                               checked />
                        <h2 class="checked"><?php echo $tarefa['titulo'] ?><h2>
                    <?php }else { ?>
                        <input type="checkbox"
                               data-todo-id ="<?php echo $tarefa['id']; ?>"
                               class="check-box" />
                        <h2><?php echo $tarefa['titulo'] ?></h2>
                    <?php } ?>
                    <small>criado em: <?php echo $tarefa['data_criacao'] ?><small> 
                </div>
            <?php } ?>
       </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.remove-to-do').click(function(){
                const id = $(this).attr('id');
                
                $.post("app/deletar.php", 
                      {
                          id: id
                      },
                      (data)  => {
                         if(data){
                             $(this).parent().hide(600);
                         }
                      }
                );
            });

            $(".check-box").click(function(e){
                const id = $(this).attr('data-todo-id');
                
                $.post('app/finalizar.php', 
                      {
                          id: id
                      },
                      (data) => {
                          if(data != 'error'){
                              const h2 = $(this).next();
                              if(data === '1'){
                                  h2.removeClass('checked');
                              }else {
                                  h2.addClass('checked');
                              }
                          }
                      }
                );
            });
        });
    </script>
</body>
</html>