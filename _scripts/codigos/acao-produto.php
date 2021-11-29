<?php
require_once("../../scripts/config/conn.php");
require_once("verifica_user.php");
require_once("dados-user.php");


$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(isset($_POST['btnCad'])){
    $erro = false;
    
    $dados = array_map('trim', $dados);
    if(in_array("", $dados)){
        $erro = true;
        echo "
            <script>
                window.alert('ERRO: Preencha todos os campos do formulario !')
                window.document.location.href='../cad-produto.php'
            </script>
        ";
    }
    
    if(!$erro){
        $dataAtual = date('Y/m/d');
        $lucroLiq  = ($dados['precVend'] * $dados['qtdVend']) - $dados['custProd']; 
        $sql = "INSERT INTO list_prod SET nome=?, precVend=?, custProd=?, 	qtdProd=?, qtdVend=?, id_user=?, dataCad=?, lucroLiq=? ";
        $sql = $conn->prepare($sql);
        $sql->bindParam(1, $dados['nomeProd']);
        $sql->bindParam(2, $dados['precVend']);
        $sql->bindParam(3, $dados['custProd']);
        $sql->bindParam(4, $dados['qtdProd']);
        $sql->bindParam(5, $dados['qtdVend']);
        $sql->bindParam(6, $dadosUser['id']);
        $sql->bindParam(7, $dataAtual);
        $sql->bindParam(8, $lucroLiq);
        $sql->execute();
        

        echo "
            <script>
                window.alert('Produto cadastrado com sucesso! ')
                window.document.location.href='../cad-produto.php'
            </script>
        ";
    }
}