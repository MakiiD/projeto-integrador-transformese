<?php


$email = filter_input(INPUT_GET,"email", FILTER_SANITIZE_EMAIL);
$nova_senha = filter_input(INPUT_POST,"nova_senha");

$connection = new mysqli("localhost","root","","deluxuniformespro-bd");

if (!empty($email) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($connection, $email);

    $query = "UPDATE cadastros SET senha = '$nova_senha' where email = '$email'";

    mysqli_query($connection, $query);

 }


 
 //echo "<h2 style='color:blue'>Um email de confirmação foi enviado para sua caixa postal!!!</h2>";
?>