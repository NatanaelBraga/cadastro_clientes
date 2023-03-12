<?php
include "conexao.php";
include "funcoes.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $rg = $_POST["rg"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $data_nascimento = $_POST["data_nascimento"];
    $cep = $_POST["cep"];
    $observacoes = $_POST["observacoes"];

    // Validar campos obrigatórios
    if (empty($nome) || empty($sobrenome) || empty($rg) || empty($cpf) || empty($email) || empty($data_nascimento) || empty($cep)) {
        echo "<script>alert('Por favor, preencha todos os campos obrigatórios.');</script>";
        exit;
    }

    // Validar RG e CPF
    if (!validar_rg($rg)) {
        echo "<script>alert('RG inválido.');</script>";
        exit;
    }
    if (!validar_cpf($cpf)) {
        echo "<script>alert('CPF inválido.');</script>";
        exit;
    }

    // Validar e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('E-mail inválido.');</script>";
        exit;
    }

    // Conectar ao banco de dados
    $conn = conectar();

    // Preparar a declaração SQL com declarações preparadas
    $stmt = mysqli_prepare($conn, "INSERT INTO Clientes (Nome, Sobrenome, RG, CPF, Email, Data_Nascimento, CEP, Endereco, Observacoes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Vincular parâmetros à declaração preparada
    mysqli_stmt_bind_param($stmt, "sssssssss", $nome, $sobrenome, $rg, $cpf, $email, $data_nascimento, $cep, $endereco, $observacoes);

    // Buscar o endereço do cliente a partir do CEP
    $endereco_completo = get_endereco_pelo_cep($cep);
    $endereco = $endereco_completo["logradouro"] . ", " . $endereco_completo["bairro"] . ", " . $endereco_completo["localidade"] . " - " . $endereco_completo["uf"];

    // Executar a declaração preparada
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
    } else {
        echo "Erro: " . mysqli_stmt_error($stmt);
    }

    // Desconectar do banco de dados
    desconectar($conn);
}
?>
<div class="container">
    <h2>Cadastro de Clientes</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
        </div>
        <div class="form-group">
            <label for
            <div class="container">
    <h2>Cadastro de Clientes</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="sobrenome">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
        </div>
        <div class="form-group">
            <label for="rg">RG:</label>
            <input type="text" class="form-control" id="rg" name="rg" required>
        </div>
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
        </div>
        <div class="form-group">
            <label for="cep">CEP:</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
        </div>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input type="text" class="form-control" id="endereco" name="endereco" readonly>
        </div>
        <div class="form-group">
            <label for="observacoes">Observações:</label>
            <textarea class="form-control" id="observacoes" name="observacoes"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        // Quando o campo de CEP perder o foco
        $("#cep").blur(function() {
            // Obtém o valor do CEP
            var cep = $(this).val();

            // Verifica se o CEP está no formato correto
            if (cep.length == 9 && cep[5] == "-") {
                // Faz a requisição para a API de CEP
                $.get("https://viacep.com.br/ws/" + cep + "/json/", function(data) {
                    // Se a requisição foi bem sucedida
                    if (data && !data.erro) {
                        // Preenche o endereço no formulário
                        $("#endereco").val(data.logradouro + ", " + data.bairro + ", " + data.localidade + " - " + data.uf);
                    }
                });
            }
        });
    });
</script>