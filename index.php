<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>PHP CRUD</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script><!-- comment -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
    <?php require_once 'process.php' ?>

<?php if (isset($_SESSION['mensagem'])): ?>
<div class="alert alert-<?=$_SESSION['msg_tipo']?>">
    <?php 
    echo $_SESSION['mensagem'];
    unset($_SESSION['mensagem']);
    ?>
</div>
<?php endif ?>

<div class="container">
   
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
    ?>
    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Localizacão</th>
                    <th colspan="2">Ação</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['localizacao']; ?></td>
                    <td>
                        <a href="index.php?editar=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </thead>
        </table>
    </div>

    <?php function pre_r($array) { echo '<pre>'; print_r($array); echo '</pre>'; } ?>
    
    <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>" placeholder="Coloque seu nome">
            </div>
            <div class="form-group">
                <label for="">Localizacão</label>
                <input type="text" name="localizacao" class="form-control" value="<?php echo $localizacao; ?>" placeholder="Enter your localizacao">
            </div>
            <div class="form-group">
                <?php if ($atualizar == true): ?>
                <button type="submit" class="btn btn-warning" name="atualizar">atualizar</button>
                <?php else: ?>
                <button type="submit" class="btn btn-primary" name="save">Save</button>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>
    </body>
</html>
