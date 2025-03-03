<?php

// Inclui o array que simula um BD
require_once("../config.php");

 
if (isset($_GET['id']) && isset($_GET['acao'])) {
    $id_usuario = $_GET['id'];
    $acao = $_GET['acao'];
    $titulo_pagina = ucfirst($acao) . " Usuário";

    //Se a ação for visualizar, o formulário não pode ser editado e o atributo disabled devem ser usado nas tags do HTML
    ($acao == "visualizar") ? $desabilitado = "disabled" : $desabilitado = "";
    

    // Procura o índice do usuário no array com base no ID
    $indice_usuario = -1;
    foreach ($_SESSION['usuariosBD'] as $indice => $usuario[0]) {
        if ($usuario[0]['id_usuario'] == $id_usuario) {
            $indice_usuario = $indice;
            break;
        }
    }

    $sql = "SELECT * FROM Usuarios WHERE id=". $id_usuario;
    $res= $conn -> query($sql);

    // Se o usuário for encontrado, preenche os dados no formulário
    if ($res==true) {
        $usuario = $res ->fetch_all(MYSQLI_ASSOC);
    } else {
        // Usuário não encontrado
        header("Location: usuario_listar.php?mensagem=Usuario+não+encontrado+ao+tentar+ " . $acao );
        exit();
    }
    
} else {
    // ID do usuário não fornecido
    header("Location: usuario_listar.php?mensagem=ID+do+usuario+ou+ação+não+fornecidos+ao+tentar+ " . $acao);
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> <?= $titulo_pagina ?> </title>
    <link rel="shortcut icon" href="img/art_logo.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

    <!-- Inclui o link para a fonte Roboto da Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">

    <!-- Inclui estilos personalizados -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- Inclui o cabeçalho dinamicamente -->
    <?php include_once("header.php"); ?>

    <div class="container pt-1 mt-2 text-muted">
        <h4> <?= $titulo_pagina ?> </h4>
    </div>
    <div class="container pt-1 shadow-sm bg-white">
        <div class="row mt-2">
            <div class="col-md-6">
                <form action="usuario_bd.php" method="post" enctype="multipart/form-data">
                    <!-- Adicione um campo hidden para armazenar o ID do usuário -->
                    <input type="hidden" name="id_usuario" value="<?= $usuario[0]['id'] ?>">
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario[0]['nome'] ?>" required <?= " $desabilitado" ?> >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $usuario[0]['email'] ?>" required <?= " $desabilitado" ?> >
                    </div>
                    <div class="mb-3">
                        <label for="data_cadastro" class="form-label">Data Cadastro:</label>
                        <input type="date" class="form-control" id="data_cadastro" name="data_cadastro" placeholder="YYYY-MM-DD" value="<?= $usuario[0]['dtcadastro'] ?>" required <?= " $desabilitado" ?> >
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="situacao" name="situacao" value="1" <?= $usuario[0]['situacao'] == 1 ? 'checked' : '' ?> <?= " $desabilitado" ?>>
                        <label class="form-check-label" for="situacao">Ativo</label>
                    </div>
                    <div class="mb-3">
                        <label for="funcao" class="form-label">Função:</label>
                        <select class="form-select" id="funcao" name="funcao" required <?= " $desabilitado" ?> >
                            <option value="1" <?= $usuario['funcao'] == 1 ? 'selected' : '' ?>>Usuário</option>
                            <option value="2" <?= $usuario['funcao'] == 2 ? 'selected' : '' ?>>Gerente</option>
                            <option value="3" <?= $usuario['funcao'] == 3 ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto (upload da imagem):</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" <?= " $desabilitado" ?>>
                    </div>
                    <div class="mb-3 col-3">
                        <label for="foto_preview" class="form-label">Preview da Foto:</label>
                        <img src="<?= isset($usuario[0]['Foto']) ? $usuario[0]['Foto'] : 'img/userpadrao.png' ?>" alt="Preview da Foto" id="foto_preview" name="foto_preview" class="img-fluid w-251 h-251 border">
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-6 ">
                        <button type="submit" class="btn btn-primary" <?= " $desabilitado" ?>>Salvar</button>
                        <a href="usuario_listar_card.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, necessário apenas para funcionalidades avançadas) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        // Exemplo de script para visualizar a foto antes de enviar o formulário
        document.getElementById('foto').addEventListener('change', function () {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('foto_preview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>

    <!-- Inclui o rodapé dinamicamente -->
    <?php include_once('footer.php'); ?>
</body>
</html>
