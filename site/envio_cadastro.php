<?php
// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "deluxuniformespro-bd";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Obter dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$numero = $_POST['numero'];
$uf = $_POST['uf'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
// Parece ser daqui mas não é  apesar de ser mesma tabela $carrinho = $_POST['carrinho'];

// Inserir dados no banco de dados
$sql = "INSERT INTO cadastros (nome, email, senha, numero, uf, endereco, cep) VALUES ('$nome', '$email', '$senha','$numero', '$uf', '$endereco', '$cep')";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
} 
else{
    header("Location: cadastro.php"). $conn->error;
}

// Fechar a conexão
$conn->close();
?>
