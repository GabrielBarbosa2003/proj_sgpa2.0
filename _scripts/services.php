<?php
require_once("../scripts/config/conn.php");
require_once("codigos/verifica_user.php");
require_once("codigos/dados-user.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Projeto Integrador</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/css/meustyle.css" rel="stylesheet">
  <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Company - v4.3.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="services.php">SEJA BEM-VINDO <span><?php echo $_SESSION['user']; ?></span> </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="services.php" class="active">produtos</a></li>

          <li class="dropdown"><a href="#"><span>Sistemas</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="cad-produto.php">Cadastrar Produto</a></li>

            </ul>
          </li>

          <li><a href="codigos/sair.php">Sair</a></li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      
    </nav>
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Produtos</h2>
          <ol>
            <li><a href="services.php">Home</a></li>
            <li>Produtos</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
    <div class="container " data-aos="fade-up">
            <form method="post">
                <div class="row mb-3">
                    <div class="ms-4 col-sm-5">
                        <div class="shadow-lg p-3 mb-5 bg-body rounded">
                        <label>Nome do Produto:</label>
                        <input name="nomePesq" style="width: 90%; height: 3em" type="text">
                        <label>Data que deseja pesquisar:</label>
                        <input name="data" style="width: 90%; height: 3em" type="date">
                        <button class="mt-5 btn btn-success" type="submit">Buscar</button>
                        </div>
                    </div>
                    <div class="ms-4 col-sm-3">
                        <div class="shadow-lg p-3 mb-5 bg-body rounded">
                        <div class="row ">
                            <div class="col-sm-12 border  text-center text-white" style="background-color: #1BBD36;">
                                TABELA DE LUCRO
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6 border  text-white" style="background-color: #1BBD36;">
                                MÊS ATUAL
                            </div>
                            <div class="col-sm-6 border text-white" style="background-color: #1BBD36;">
                                <?php
                                    $d = "01";
                                    $m = date('m');
                                    $a = date('Y');
                                    
                                    $mesAtual = $a."-".$m."-".$d;
                                    $sqlLucroMes = "SELECT sum(lucroLiq) AS soma_lucro_mes FROM list_prod WHERE dataCad>? AND id_user=? ";
                                    $sqlLucroMes = $conn->prepare($sqlLucroMes);
                                    $sqlLucroMes->bindParam(1, $mesAtual);
                                    $sqlLucroMes->bindParam(2, $dadosUser['id']);
                                    $sqlLucroMes->execute();
                                    $lucroMes = $sqlLucroMes->fetch(PDO::FETCH_ASSOC);

                                    if($lucroMes['soma_lucro_mes'] = 0){
                                        echo "-";
                                    }else{
                                        echo "R$".$lucroMes['soma_lucro_mes'];
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6 border text-white" style="background-color: #1BBD36;">
                                <?php
                                    $day = date('w');

                                    $inicioSemana = date('Y-m-d', strtotime('-'.$day.' days'));
                                ?>
                                SEMANA
                            </div>
                            <div class="col-sm-6 border text-white" style="background-color: #1BBD36;">
                                <?php
                                    $sqlLucroSema = "SELECT sum(lucroLiq) AS soma_lucro_semana FROM list_prod WHERE dataCad>=? AND id_user=? ";
                                    $sqlLucroSema = $conn->prepare($sqlLucroSema);
                                    $sqlLucroSema->bindParam(1, $inicioSemana);
                                    $sqlLucroSema->bindParam(2, $dadosUser['id']);
                                    $sqlLucroSema->execute();
                                    $lucroSemana = $sqlLucroSema->fetch(PDO::FETCH_ASSOC);

                                    if($lucroSemana['soma_lucro_semana'] < 1){
                                        echo "-";
                                    }else {
                                        echo "R$".$lucroSemana['soma_lucro_semana'];
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-sm-6 border text-white" style="background-color: #1BBD36;">
                                DIA (<?php $dataDiaAtual = date('d/m/y'); echo $dataDiaAtual; ?>)
                            </div>
                            <div class="col-sm-6 border text-white" style="background-color: #1BBD36;">
                                <?php
                                    $diaAtual = date('Y-m-d');
                                    $sqlLucroDia = "SELECT sum(lucroLiq) AS soma_lucro_dia FROM list_prod WHERE dataCad=? AND id_user=? ";
                                    $sqlLucroDia = $conn->prepare($sqlLucroDia);
                                    $sqlLucroDia->bindParam(1, $diaAtual);
                                    $sqlLucroDia->bindParam(2, $dadosUser['id']);
                                    $sqlLucroDia->execute();
                                    $lucroDia = $sqlLucroDia->fetch(PDO::FETCH_ASSOC);
                                    
                                    if($lucroDia['soma_lucro_dia'] < 1){
                                        echo "-";
                                    }else{
                                        echo "R$".$lucroDia['soma_lucro_dia'];
                                    }
                                ?>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-5 ms-4">
                    <?php if(isset($_GET['id'])) { 
                        $sqlDet = "SELECT * FROM list_prod WHERE id=? AND id_user=?";
                        $sqlDet = $conn->prepare($sqlDet);
                        $sqlDet->bindParam(1, $_GET['id']);
                        $sqlDet->bindParam(2, $dadosUser['id']);
                        $sqlDet->execute();
                        $sqlDetFetch = $sqlDet->fetch(PDO::FETCH_ASSOC);
                        $sqlDetRow = $sqlDet->rowCount();
                        
                        $receita = $sqlDetFetch['precVend'] * $sqlDetFetch['qtdVend'];
                        $liquido = $receita - $sqlDetFetch['custProd'];
                        $marge = ($liquido / $receita) * 100;
                        $marge = number_format((float)$marge,2, ',','');
                        if($sqlDetRow > 0){?>
                        <div class="card text-white  shadow-lg p-3 mb-5 rounded " style="background-color: #1BBD36;">
                          <div class="card-header" style="background-color: #1BBD36;">
                            <?php echo $sqlDetFetch['nome']; ?>
                          </div>
                          <div class="card-body">
                            <p class="card-text">Preço de Venda: R$<?php echo $sqlDetFetch['precVend']; ?></p>
                            <p class="card-text">Custo de Produção: R$<?php echo $sqlDetFetch['custProd']; ?></p>
                            <p class="card-text">Qtd. Produzido: <?php echo $sqlDetFetch['qtdProd']; ?> UND</p>
                            <p class="card-text">Qtd. Vendida: <?php echo $sqlDetFetch['qtdVend']; ?> UND</p>
                            <hr>
                            <p class="card-text">Receita de Venda: R$<?php echo $receita; ?></p>
                            <p class="card-text">Receita Liquida: R$<?php echo $liquido; ?></p>
                            <p class="card-text">Margem de Lucro: <?php echo $marge; ?>%</p>
                          </div>
                        </div>

                        
                        <?php } ?>
                    <?php } ?>
                    </div>
                </div>
            </form>
        <?php 
          if(isset($_POST['data']) AND isset($_POST['nomePesq'])){
              $_POST['nomePesq'] = trim($_POST['nomePesq']);
              $_POST['data'] = trim($_POST['data']);
              
          }
             
          if(!isset($_POST['data']) || $_POST['data'] == ""  AND !isset($_POST['nomePesq']) || $_POST['nomePesq'] == ""){   
        ?>      
        
               <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Descrição do Produto
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Preço de Venda
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Custo de Produção
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Produzida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Vendida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white"style="background-color: #1BBD36;">
                        Ação
                    </div>
                </div>
        
                <?php 
                    $pagina_atual = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);
                    
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    
                    $limite_registro = 5;
                    
                    $inicio = ($limite_registro * $pagina) - $limite_registro;
                    if(!isset($_GET['p'])){
                        echo "
                            <script>
                                window.document.location.href='services.php?p=1'
                            </script>
                        ";
                    }
                    
                    
                    
                    $sqlLis = "SELECT * FROM list_prod WHERE id_user=? ORDER BY id DESC LIMIT $inicio, $limite_registro";
                    $sqlLis = $conn->prepare($sqlLis);
                    $sqlLis->bindParam(1, $dadosUser['id']);
                    $sqlLis->execute();
                    $sqlLisRow = $sqlLis->rowCount();
                
                if($sqlLisRow > 0){
                    while($sqlLisFetch = $sqlLis->fetch(PDO::FETCH_ASSOC)){
                        echo '   <div class="row">
                    
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['nome'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['precVend'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['custProd'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdProd'].' UND
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdVend'].' UND
                                </div>
                                <div class="col-sm-2 text-break border">
                                    <a class="btn btn-outline-success btn-sm mt-1 ms-2" href="edit.php?id='.$sqlLisFetch['id'].'">EDITAR</a>
                                    <a class="btn btn-outline-success btn-sm mt-1 " href="delete.php?id='.$sqlLisFetch['id'].'">DELETAR</a>
                                    <a class="btn btn-outline-success btn-sm my-1 ms-3 " href="services.php?p='.$_GET['p'].'&id='.$sqlLisFetch['id'].'">DETALHE</a>
                                </div>
                            </div>
                        ';
                    }
        echo "</div>";

                    $sqlQntPage = "SELECT COUNT(id) AS num_result FROM list_prod WHERE id_user=?";
                    $sqlQntPage = $conn->prepare($sqlQntPage);
                    $sqlQntPage->bindParam(1, $dadosUser['id']);
                    $sqlQntPage->execute();
                    $fetchQntPage = $sqlQntPage->fetch(PDO::FETCH_ASSOC);
                    
                    $qnt_page = ceil($fetchQntPage['num_result'] / $limite_registro);
                    $maximoLink = 1;
                    
                    
                    echo '
                        <nav aria-label="Page navigation example ">
                          <ul class="pagination mt-3 test">
                            <li class="page-item"><a class="page-link" href="services.php?p=1">Primeira</a></li>';
                            if($_GET['p'] > 1){
                                 for($pagina_anterior = $pagina - $maximoLink; $pagina_anterior <= $pagina -1; $pagina_anterior++){
                                    echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';
                                 }
                            }
        
        
                    echo '  <li class="page-item active"><a class="page-link" href="services.php?p='.$_GET['p'].'">'.$_GET['p'].'</a></li>';
                        if($_GET['p'] < $qnt_page){
                            for($pagina_proxima = $pagina +1; $pagina_proxima <= $pagina + $maximoLink; $pagina_proxima++){
                                echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_proxima.'">'.$pagina_proxima.'</a></li>';
                            }
                        }
                            
                    echo '    <li class="page-item"><a class="page-link" href="services.php?p='.$qnt_page.'">Ultima</a></li>
                          </ul>
                        </nav>
                    ';
                }else{
                echo '
                    <div class="alert alert-warning text-center" role="alert">
                        Você não tem nenhum produto cadastro. 
                    </div> 
                ';
                }
                ?>
            </div>
        <?php
          }elseif($_POST['data'] != "" AND $_POST['nomePesq'] == ""){ ?>
          
               <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Descrição do Produto
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Preço de Venda
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Custo de Produção
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Produzida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Vendida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Ação
                    </div>
                </div>
        
                <?php 
                    $pagina_atual = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);
                    
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    
                    $limite_registro = 5;
                    
                    $inicio = ($limite_registro * $pagina) - $limite_registro;
                    if(!isset($_GET['p'])){
                        echo "
                            <script>
                                window.document.location.href='services.php?p=1'
                            </script>
                        ";
                    }
                    
                    
                    $dataPesquisada = filter_input(INPUT_POST, "data", FILTER_DEFAULT);
                    $sqlLis = "SELECT * FROM list_prod WHERE id_user=? AND dataCad=? ORDER BY id DESC LIMIT $inicio, $limite_registro";
                    $sqlLis = $conn->prepare($sqlLis);
                    $sqlLis->bindParam(1, $dadosUser['id']);
                    $sqlLis->bindParam(2, $dataPesquisada);
                    $sqlLis->execute();
                    $sqlLisRow = $sqlLis->rowCount();
                
                if($sqlLisRow > 0){
                    while($sqlLisFetch = $sqlLis->fetch(PDO::FETCH_ASSOC)){
                        echo '   <div class="row">
                    
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['nome'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['precVend'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['custProd'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdProd'].' UND
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdVend'].' UND
                                </div>
                                <div class="col-sm-2 text-break border">
                                    <a class="btn btn-outline-success btn-sm mt-1 ms-2" href="edit.php?id='.$sqlLisFetch['id'].'">EDITAR</a>
                                    <a class="btn btn-outline-success btn-sm mt-1 " href="delete.php?id='.$sqlLisFetch['id'].'">DELETAR</a>
                                    <a class="btn btn-outline-success btn-sm my-1 ms-3 " href="detalhe.php?id='.$sqlLisFetch['id'].'">DETALHE</a>
                                </div>
                            </div>
                        ';
                    }
        echo "</div>";
                    $sqlQntPage = "SELECT COUNT(id) AS num_result FROM list_prod WHERE id_user=?  AND dataCad=?";
                    $sqlQntPage = $conn->prepare($sqlQntPage);
                    $sqlQntPage->bindParam(1, $dadosUser['id']);
                    $sqlQntPage->bindParam(2, $dataPesquisada);
                    $sqlQntPage->execute();
                    $fetchQntPage = $sqlQntPage->fetch(PDO::FETCH_ASSOC);
                    
                    $qnt_page = ceil($fetchQntPage['num_result'] / $limite_registro);
                    $maximoLink = 1;
                    
                    
                    echo '
                        <nav aria-label="Page navigation example ">
                          <ul class="pagination mt-3 test">
                            <li class="page-item"><a class="page-link" href="services.php?p=1">Primeira</a></li>';
                            if($_GET['p'] > 1){
                                 for($pagina_anterior = $pagina - $maximoLink; $pagina_anterior <= $pagina -1; $pagina_anterior++){
                                    echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';
                                 }
                            }
        
        
                    echo '  <li class="page-item active"><a class="page-link" href="services.php?p='.$_GET['p'].'">'.$_GET['p'].'</a></li>';
                        if($_GET['p'] < $qnt_page){
                            for($pagina_proxima = $pagina +1; $pagina_proxima <= $pagina + $maximoLink; $pagina_proxima++){
                                echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_proxima.'">'.$pagina_proxima.'</a></li>';
                            }
                        }
                            
                    echo '    <li class="page-item"><a class="page-link" href="services.php?p='.$qnt_page.'">Ultima</a></li>
                          </ul>
                        </nav>
                    ';
                }else{
                echo '
                    <div class="alert alert-warning text-center" role="alert">
                        Você não tem nenhum produto cadastro. 
                    </div> 
                ';
                }
                ?>
            </div>
          
         <?php }elseif($_POST['nomePesq'] != "" AND $_POST['data'] == "") {?>
               <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Descrição do Produto
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Preço de Venda
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Custo de Produção
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Produzida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Vendida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Açã                    </div>
                </div>
        
                <?php 
                    $pagina_atual = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);
                    
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    
                    $limite_registro = 5;
                    
                    $inicio = ($limite_registro * $pagina) - $limite_registro;
                    if(!isset($_GET['p'])){
                        echo "
                            <script>
                                window.document.location.href='services.php?p=1'
                            </script>
                        ";
                    }
                    
                    
                    $nomePesquisado = filter_input(INPUT_POST, "nomePesq", FILTER_DEFAULT);
                    $sqlLis = "SELECT * FROM list_prod WHERE id_user=? AND nome=? ORDER BY id DESC LIMIT $inicio, $limite_registro";
                    $sqlLis = $conn->prepare($sqlLis);
                    $sqlLis->bindParam(1, $dadosUser['id']);
                    $sqlLis->bindParam(2, $nomePesquisado);
                    $sqlLis->execute();
                    $sqlLisRow = $sqlLis->rowCount();
                
                if($sqlLisRow > 0){
                    while($sqlLisFetch = $sqlLis->fetch(PDO::FETCH_ASSOC)){
                        echo '   <div class="row">
                    
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['nome'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['precVend'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['custProd'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdProd'].' UND
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdVend'].' UND
                                </div>
                                <div class="col-sm-2 text-break border">
                                    <a class="btn btn-outline-success btn-sm mt-1 ms-2" href="edit.php?id='.$sqlLisFetch['id'].'">EDITAR</a>
                                    <a class="btn btn-outline-success btn-sm mt-1 " href="delete.php?id='.$sqlLisFetch['id'].'">DELETAR</a>
                                    <a class="btn btn-outline-success btn-sm my-1 ms-3 " href="detalhe.php?id='.$sqlLisFetch['id'].'">DETALHE</a>
                                </div>
                            </div>
                        ';
                    }
        echo "</div>";
                    $sqlQntPage = "SELECT COUNT(id) AS num_result FROM list_prod WHERE id_user=?  AND nome=?";
                    $sqlQntPage = $conn->prepare($sqlQntPage);
                    $sqlQntPage->bindParam(1, $dadosUser['id']);
                    $sqlQntPage->bindParam(2, $nomePesquisado);
                    $sqlQntPage->execute();
                    $fetchQntPage = $sqlQntPage->fetch(PDO::FETCH_ASSOC);
                    
                    $qnt_page = ceil($fetchQntPage['num_result'] / $limite_registro);
                    $maximoLink = 1;
                    
                    
                    echo '
                        <nav aria-label="Page navigation example ">
                          <ul class="pagination mt-3 test">
                            <li class="page-item"><a class="page-link" href="services.php?p=1">Primeira</a></li>';
                            if($_GET['p'] > 1){
                                 for($pagina_anterior = $pagina - $maximoLink; $pagina_anterior <= $pagina -1; $pagina_anterior++){
                                    echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';
                                 }
                            }
        
        
                    echo '  <li class="page-item active"><a class="page-link" href="services.php?p='.$_GET['p'].'">'.$_GET['p'].'</a></li>';
                        if($_GET['p'] < $qnt_page){
                            for($pagina_proxima = $pagina +1; $pagina_proxima <= $pagina + $maximoLink; $pagina_proxima++){
                                echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_proxima.'">'.$pagina_proxima.'</a></li>';
                            }
                        }
                            
                    echo '    <li class="page-item"><a class="page-link" href="services.php?p='.$qnt_page.'">Ultima</a></li>
                          </ul>
                        </nav>
                    ';
                }else{
                echo '
                    <div class="alert alert-warning text-center" role="alert">
                        Você não tem nenhum produto cadastro. 
                    </div> 
                ';
                }
                ?>
            </div>

         
         <?php }elseif($_POST['nomePesq'] != "" AND $_POST['data'] != ""){ ?>
         
               <div class="shadow-lg p-3 mb-5 bg-body rounded">
                <div class="row">
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Descrição do Produto
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Preço de Venda
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Custo de Produção
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Produzida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Qtd. Vendida
                    </div>
                    <div class="col-sm-2 text-break border card-body text-center text-white" style="background-color: #1BBD36;">
                        Ação
                    </div>
                </div>
        
                <?php 
                    $pagina_atual = filter_input(INPUT_GET, "p", FILTER_SANITIZE_NUMBER_INT);
                    
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    
                    $limite_registro = 5;
                    
                    $inicio = ($limite_registro * $pagina) - $limite_registro;
                    if(!isset($_GET['p'])){
                        echo "
                            <script>
                                window.document.location.href='services.php?p=1'
                            </script>
                        ";
                    }
                    
                    
                    $dataPesquisada = filter_input(INPUT_POST, "data", FILTER_DEFAULT);
                    $nomePesquisado = filter_input(INPUT_POST, "nomePesq", FILTER_DEFAULT);
                    
                    $sqlLis = "SELECT * FROM list_prod WHERE id_user=? AND dataCad=? AND nome=? ORDER BY id DESC LIMIT $inicio, $limite_registro";
                    $sqlLis = $conn->prepare($sqlLis);
                    $sqlLis->bindParam(1, $dadosUser['id']);
                    $sqlLis->bindParam(2, $dataPesquisada);
                    $sqlLis->bindParam(3, $nomePesquisado);
                    $sqlLis->execute();
                    $sqlLisRow = $sqlLis->rowCount();
                
                if($sqlLisRow > 0){
                    while($sqlLisFetch = $sqlLis->fetch(PDO::FETCH_ASSOC)){
                        echo '   <div class="row">
                    
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['nome'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['precVend'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    R$'.$sqlLisFetch['custProd'].'
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdProd'].' UND
                                </div>
                                <div class="col-sm-2 text-break border card-body text-center">
                                    '.$sqlLisFetch['qtdVend'].' UND
                                </div>
                                <div class="col-sm-2 text-break border">
                                    <a class="btn btn-outline-success btn-sm mt-1 ms-2" href="edit.php?id='.$sqlLisFetch['id'].'">EDITAR</a>
                                    <a class="btn btn-outline-success btn-sm mt-1 " href="delete.php?id='.$sqlLisFetch['id'].'">DELETAR</a>
                                    <a class="btn btn-outline-success btn-sm my-1 ms-3 " href="detalhe.php?id='.$sqlLisFetch['id'].'">DETALHE</a>
                                </div>
                            </div>
                        ';
                    }
        echo "</div>";
                    $sqlQntPage = "SELECT COUNT(id) AS num_result FROM list_prod WHERE id_user=?  AND dataCad=? AND nome=?";
                    $sqlQntPage = $conn->prepare($sqlQntPage);
                    $sqlQntPage->bindParam(1, $dadosUser['id']);
                    $sqlQntPage->bindParam(2, $dataPesquisada);
                    $sqlQntPage->bindParam(3, $nomePesquisado);
                    $sqlQntPage->execute();
                    $fetchQntPage = $sqlQntPage->fetch(PDO::FETCH_ASSOC);
                    
                    $qnt_page = ceil($fetchQntPage['num_result'] / $limite_registro);
                    $maximoLink = 1;
                    
                    
                    echo '
                        <nav aria-label="Page navigation example ">
                          <ul class="pagination mt-3 test">
                            <li class="page-item"><a class="page-link" href="services.php?p=1">Primeira</a></li>';
                            if($_GET['p'] > 1){
                                 for($pagina_anterior = $pagina - $maximoLink; $pagina_anterior <= $pagina -1; $pagina_anterior++){
                                    echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_anterior.'">'.$pagina_anterior.'</a></li>';
                                 }
                            }
        
        
                    echo '  <li class="page-item active"><a class="page-link" href="services.php?p='.$_GET['p'].'">'.$_GET['p'].'</a></li>';
                        if($_GET['p'] < $qnt_page){
                            for($pagina_proxima = $pagina +1; $pagina_proxima <= $pagina + $maximoLink; $pagina_proxima++){
                                echo '<li class="page-item"><a class="page-link" href="services.php?p='.$pagina_proxima.'">'.$pagina_proxima.'</a></li>';
                            }
                        }
                            
                    echo '    <li class="page-item"><a class="page-link" href="services.php?p='.$qnt_page.'">Ultima</a></li>
                          </ul>
                        </nav>
                    ';
                }else{
                echo '
                    <div class="alert alert-warning text-center" role="alert">
                        Você não tem nenhum produto cadastro. 
                    </div> 
                ';
                }
                ?>
            </div>
          
         <?php } ?>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-sm-lg-3 col-sm-md-6 footer-contact">
            <h3>Projeto</h3>
            <p>
             esse site é destinado ao projeto<br>dos Alunos da escol-sma IFSP de Campinas<br> da materia Projeto integrador.<br><br>
             
            </p>
          </div>

          

          

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Company</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
     
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/aos/aos.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="../assets/vendor/waypoints/noframework.waypoints.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>