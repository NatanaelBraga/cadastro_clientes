<?php
// Conexão com o banco de dados
$servername = "NEITAN\SQLEXRESS"; // nome do servidor do banco de dados
$username = "sa"; // nome do usuário do banco de dados
$password = "senha123"; // senha do usuário do banco de dados
$dbname = "Cadastro_Clientes"; // nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
