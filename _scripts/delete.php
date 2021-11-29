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
          <h2>Deletar</h2>
          <ol>
            <li><a href="services.php">Home</a></li>
            <li>Deletar</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg text-center">
    <div class="container" data-aos="fade-up">
        
        <?php
        
        if(isset($_POST['resp'])){
            
            if($_POST['resp'] == "sim"){
            
                $sqlDel = "SELECT * FROM list_prod WHERE id=? AND id_user=?";
                $sqlDel = $conn->prepare($sqlDel);
                $sqlDel->bindParam(1, $_GET['id']);
                $sqlDel->bindParam(2, $dadosUser['id']);
                $sqlDel->execute();
                $sqlRow = $sqlDel->rowCount();
                
                if($sqlRow > 0){
                    $sqlDel = "DELETE FROM list_prod WHERE id=? AND id_user=?";
                    $sqlDel = $conn->prepare($sqlDel);
                    $sqlDel->bindParam(1, $_GET['id']);
                    $sqlDel->bindParam(2, $dadosUser['id']);
                    $sqlDel->execute();
                    $sqlRow = $sqlDel->rowCount();
                    
                    if($sqlRow > 0){
                        echo "
                            <script>
                                window.alert('Produto deletado do Banco de Dados !')
                                window.document.location.href='services.php'
                            </script>
                        ";
                    }
                    
                }else{
                    echo "
                        <script>
                            window.alert('Produto invalido !')
                            window.document.location.href='services.php'
                        </script>
                    ";
                }
            }elseif($_POST['resp'] == "nao"){
                    echo "
                        <script>
                            window.document.location.href='services.php'
                        </script>
                    ";
            }else{
                    echo "
                        <script>
                            window.alert('Opção invalida !')
                        </script>
                    ";
            }
            
        }
        ?>
        <form action="" method="post" class="border rounded-3 bg-danger p-3">
            <div class="row">
                <div class="col-12 text-warning">
                    VOCÊ REALMENTE DESEJA DELETAR ESSE PRODUTO ?
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="row">
                        <div class="col">
                            <div class="form-check text-warning">
                                <input class="form-check-input" type="radio" name="resp" value="sim" id="inputRadio1" >
                                <label class="form-check-label" for="inputRadio1"> SIM </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-check text-warning">
                                <input class="form-check-input" type="radio" name="resp" value="nao" id="inputRadio2" >
                                <label class="form-check-label" for="inputRadio2"> NÃO </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <input type="submit" value="Confirmar" >
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