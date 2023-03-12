<?php
// Informações de conexão com o banco de dados
$serverName = "NEITAN\SQLEXRESS"; // nome do servidor
$connectionInfo = array(
    "Database" => "Cadastro_Clientes", // nome do banco de dados
    "UID" => "usuario", // nome do usuário
    "PWD" => "senha" // senha do usuário
);

// Função para conectar-se ao banco de dados
function conectar() {
    global $serverName, $connectionInfo;
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}
?>
