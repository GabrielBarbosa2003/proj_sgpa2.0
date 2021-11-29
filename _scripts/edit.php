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

      <h1 class="logo me-auto"><a href="services.php">SEJA BEM-VINDO <span><?php echo $dadosUser['nome']; ?></span> </a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a href="services.php" class="active">Produtos</a></li>

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
          <h2>Editar</h2>
          <ol>
            <li><a href="services.php">Home</a></li>
            <li>Editar</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
        <?php
                    if(!isset($_GET['id']) || $_GET['id'] < 1){
                        echo "
                            <script>
                                window.document.location.href='services.php';
                            </script>
                        ";
                    }else{
                        $id = filter_var($_GET['id'], FILTER_DEFAULT);
                        $sql = "SELECT * FROM list_prod WHERE id=? AND id_user=?";
                        $sql = $conn->prepare($sql);
                        $sql->bindParam(1, $id);
                        $sql->bindParam(2, $dadosUser['id']);
                        $sql->execute();
                        $sqlRow = $sql->rowCount();
                        $sqlFetch = $sql->fetch(PDO::FETCH_ASSOC);
                        
                        if($sqlRow < 1){
                            echo "
                                <script>
                                    window.alert('ERRO: Produto invalido !')
                                    window.document.location.href='services.php'
                                </script>
                            ";
                        }
                    }
                        
                        if(isset($_POST['btnEdit'])){
                            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                            $id = filter_var($_GET['id'], FILTER_DEFAULT);
            
                            $sql = "UPDATE list_prod SET nome=?, precVend=?, custProd=?, qtdProd=?, qtdVend=? WHERE id=? AND id_user=?";
                            $sql = $conn->prepare($sql);
                            $sql->bindParam(1, $dados['nomeProd']);
                            $sql->bindParam(2, $dados['precVend']);
                            $sql->bindParam(3, $dados['custProd']);
                            $sql->bindParam(4, $dados['qtdProd']);
                            $sql->bindParam(5, $dados['qtdVend']);
                            $sql->bindParam(6, $id);
                            $sql->bindParam(7, $dadosUser['id']);
                            $sql->execute();

                            

                            
                            echo "
                                <script>
                                    window.alert('Produto Editado com sucesso !')
                                    window.document.location.href='services.php'
                                </script>
                            ";
        
                        
                        
                        
                    }
                    
                
        ?>
        <form class="form" method="post" action="">
            
            <label>Nome do Produto</label><br />
            <input class="input-text" type="text" name="nomeProd" value="<?php echo $sqlFetch['nome']; ?>"/><br /><br /><br />
            
            <span style="color:red;">OBS: PARA NUMEROS DICIMAIS USEM " . " AO INVEZ DE  " , " </span><br /> <br />  
            <label>Preço de Venda</label><br />
            <input class="input-text" type="number" step="0.01" name="precVend" value="<?php echo $sqlFetch['precVend']; ?>"/><br /><br />
            
            <label>Custo de Produção</label><br />
            <input class="input-text" type="number" step="0.01" name="custProd" value="<?php echo $sqlFetch['custProd']; ?>"/><br /><br />
            
            <label>Quantidade Produzida</label><br />
            <input class="input-text" type="number" step="0.01" name="qtdProd" value="<?php echo $sqlFetch['qtdProd']; ?>"/><br /><br />
            
            <label>Quantidade Vendida</label><br />
            <input class="input-text" type="number" step="0.01" name="qtdVend" value="<?php echo $sqlFetch['qtdVend']; ?>"/><br /><br />
            
            
            <input class="submit" type="submit" name="btnEdit" value="Editar Produto" />
            
        </form>
      </div>
    </section><!-- End Features Section -->

  </main><!-- End #main -->

 <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Projeto</h3>
            <p>
             esse site é destinado ao projeto<br>dos Alunos da escola IFSP de Campinas<br> da materia Projeto integrador.<br><br>
             
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