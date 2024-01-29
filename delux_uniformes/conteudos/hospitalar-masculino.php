
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--FavIcon--> <link rel="shortcut icon" href="./imagens/icons/atual/produtos.ico" type="image/x-icon">
  <title>Uniformes Masculino Hospitalar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      background-color: #f5f5f5;
    }

    .hospitalarmasc {
      color: #fff;
      text-align: center;
      padding: 350px;
      background-image: url('./imagens/Img-Ref/Atual/hospitalar-masc.png');
      /* Imagem de fundo adicionada */
      background-size: cover;
    
    }

    .principal {
      text-align: center;
      padding: 20px;
    }

    .image-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      padding: 20px;
    }

    .image-container>div {
      text-align: center;
      margin: 20px;
      background-color: #fff;
      /* Fundo branco para destacar as imagens e descrições */
      padding: 15px;
      border-radius: 8px;
      /* Cantos arredondados */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      /* Sombra suave */
      transition: transform 0.3s ease;
      /* Efeito de transição suave */
    }

    .image-container>div:hover {
      transform: scale(1.05);
      /* Aumenta ligeiramente ao passar o mouse */
    }

    .image-container img {
      width: 100%;
      height: auto;
      max-width: 200px;
      border-radius: 8px;
      /* Cantos arredondados para as imagens */
    }

    .image-container .description {
      width: 100%;
      margin-top: 10px;
    }

    @media screen and (max-width: 768px) {
      header {
        font-size: 18px;
        /* Reduz a fonte no cabeçalho para dispositivos menores */
      }

      .image-container>div {
        width: 90%;
        /* Utiliza a largura máxima para dispositivos menores */
      }
    }
  </style>



</head>

<body>
<?php include("heade-produtos.php");?>
  <header class="hospitalarmasc"></header>
  <div class="principal">
  <h1>Uniformes Masculino Hospitalar</h1>
    <p>
      Explore nossa linha de uniformes hospitalares masculinos, projetados para profissionais dedicados ao cuidado da saúde com estilo e conforto. 
    </p>
    <p>
      Nossos uniformes combinam praticidade e elegância, proporcionando um visual profissional enquanto realiza suas importantes tarefas no ambiente hospitalar.
    </p>
  </div>
    <div class="image-container">
      <!-- dinamico aqui -->

    <?php 

    include '../site/config/connect.php';

  if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
      $searchTerm = filter_input(INPUT_GET, 'search');
      $sqlProdutos = "SELECT * FROM produtos WHERE tipo = 'hospitalar-masculino' AND descricao LIKE '%$searchTerm%'";
  } else {
      $sqlProdutos = "SELECT * FROM produtos WHERE tipo = 'hospitalar-masculino'";
  }

    
    $resultProdutos = $conn->query($sqlProdutos);
    
    // Exibir os produtos dinamicamente
    while ($rowProduto = $resultProdutos->fetch_assoc()) {
        echo '<div>';
        echo '<img src="./imagens/Img-Produtos/Img-Masculino/' . $rowProduto['imagem'] . '" alt="' . $rowProduto['descricao'] . '">';
        echo '<p>' . $rowProduto['descricao'] . '</p>';
        echo '<br>';
        echo '<input type="number" class="form-control" id="quantity" name="quantity" min="1" placeholder="Qtd:" style="width:80px;">';
        echo '<br>';
        echo '<br>';
        echo '<a class="add-to-cart" style="text-decoration: none;" href="../site/login.php">';
        echo '<img src="./imagens/icons/atual/carrinho.png" style="height:25px; width:25px;" alt="adicionar_carrinho">+';
        echo '</a>';
        echo '</div>';
    }
    
    ?>
    <!-- ------------------------------- -->

  </div>
</body>
<?php include_once("./footer-formas-pagamento.php");?>

