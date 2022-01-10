<?php
session_start();
$id = 0;
$atualizar = false;
$nome = '';
$localizacao = '';

//Conectando ao banco de dados
$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

// INSERE
if (isset($_POST['save'])) {
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];

    $mysqli->query("INSERT INTO data (nome, localizacao) VALUES('$nome', '$localizacao')") or die($mysqli->error);

    $_SESSION['mensagem'] = "Alterações foram salvas!";
    $_SESSION['msg_tipo'] = "sucesso";

    header("location: index.php");
}

//DELETA
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die ($mysqli->error);

    $_SESSION['mensagem'] = "Alterações foram deletadas";
    $_SESSION['msg_tipo'] = "danger";

    header("location: index.php");
}

//EDITA
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $atualizar = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if ($result->num_rows) {
        $row = $result->fetch_array();        
        $nome = $row['nome'];
        $localizacao = $row['localizacao'];            
    }    
}

if (isset($_POST['atualizar'])){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $localizacao = $_POST['localizacao'];
    
    $mysqli->query("UPDATE data SET nome='$nome', localizacao='$localizacao' WHERE id=$id") or die($mysqli->error);
    $_SESSION['mensagem'] = "Atualizado com sucesso";
    $_SESSION['msg_tipo'] = "aviso";
    
    header("location: index.php");
}
?>