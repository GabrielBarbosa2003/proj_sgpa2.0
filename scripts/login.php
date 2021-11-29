<?php
require_once("config/conn.php");

 $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if(isset($_POST['btnLog'])){
    
   $sql = "SELECT * FROM cadastro WHERE email=? AND senha=?";
   $sql = $conn->prepare($sql);
   $sql->bindParam(1, $dados['email']);
   $senhaSHA1 = sha1($dados['senha']);
   $sql->bindParam(2, $senhaSHA1);
   $sql->execute();
   $sqlRow = $sql->rowCount();
   $sqlFetch = $sql->fetch(PDO::FETCH_ASSOC);
   
   if($sqlRow > 0){
       $_SESSION['user'] = $sqlFetch['nome'];
       $user = $_SESSION['user'];
         echo "
            <script>
                window.alert('Seja Bem Vindo: ".$user."');
                window.document.location.href='../_scripts/services.php';
            </script>
         ";
   }else{
         echo "
            <script>
                window.alert('ERRO: E-mail ou senha incorreto !');
                window.document.location.href='../login.html';
            </script>
         ";
   }
   
}