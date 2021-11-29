<?php
$sqlUser = "SELECT * FROM cadastro WHERE nome=?";
$sqlUser = $conn->prepare($sqlUser);
$sqlUser->bindParam(1, $_SESSION['user']);
$sqlUser->execute();
$dadosUser = $sqlUser->fetch(PDO::FETCH_ASSOC);
