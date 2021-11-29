<?php
require_once("config/conn.php");

if(isset($_POST['btnCad'])){
     $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
     $erro = false;
     
     $dados = array_map('trim', $dados);
     if(in_array("", $dados)){
         $erro = true;
         echo "
            <script>
                window.alert('ERRO: Preencha todos os dados do formulario!');
                window.document.location.href='../cadastro.html';
            </script>
         ";
     }elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
         $erro = true;
          echo "
            <script>
                window.alert('ERRO: Digite um e-mail valido!');
                window.document.location.href='../cadastro.html';
            </script>
        ";
     }
     
     
     $sql = "SELECT * FROM cadastro WHERE email=?";
     $sql = $conn->prepare($sql);
     $sql->bindParam(1, $dados['email']);
     $sql->execute();
     $sqlRow = $sql->rowCount();
     
    echo $sqlRow;
     if($sqlRow > 0){
         $erro = true;
          echo "
            <script>
                window.alert('ERRO: E-mail já está em uso!');
                window.document.location.href='../cadastro.html';
            </script>
        ";
     }
     
     if(!$erro){
         $sqlCad = "INSERT INTO cadastro SET nome=?, email=?, senha=?, cidade=?, estado=?, dataNasc=?";
         $sqlPdo = $conn->prepare($sqlCad);
         $sqlPdo->bindParam(1, $dados['nome']);
         $sqlPdo->bindParam(2, $dados['email']);
         $teste = sha1($dados['senha']);
         $sqlPdo->bindParam(3, $teste);
         $sqlPdo->bindParam(4, $dados['cidade']);
         $sqlPdo->bindParam(5, $dados['estado']);
         $sqlPdo->bindParam(6, $dados['dataNasc']);
         $sqlPdo->execute();
         
          echo "
            <script>
                window.alert('Usuario cadastro com sucesso !');
                window.document.location.href='../cadastro.html';
            </script>
        ";
     }
     
     
    
    
}