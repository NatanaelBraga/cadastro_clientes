<?php

function get_address_by_cep($cep) {
    $url = "https://viacep.com.br/ws/$cep/json/";
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    if (isset($data["erro"])) {
        return null;
    } else {
        return $data;
    }
}

function fill_address() {
    $cep = $_POST["cep"];
    $address_data = get_address_by_cep($cep);
    if ($address_data) {
        echo "<p>Endereço encontrado:</p>";
        echo "<p>CEP: " . $address_data["cep"] . "</p>";
        echo "<p>Rua: " . $address_data["logradouro"] . "</p>";
        echo "<p>Bairro: " . $address_data["bairro"] . "</p>";
        echo "<p>Cidade: " . $address_data["localidade"] . "</p>";
        echo "<p>Estado: " . $address_data["uf"] . "</p>";
    } else {
        echo "<p>CEP não encontrado.</p>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Preencher Endereço</title>
</head>
<body>
	<h1>Preencher Endereço</h1>
	<form method="POST">
		<label>CEP:</label>
		<input type="text" name="cep">
		<button type="submit">Buscar</button>
	</form>
	<?php
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
	        fill_address();
	    }
	?>
</body>
</html>


// Função para calcular a idade do cliente a partir da data de nascimento
function calcular_idade($data_nascimento) {
    $agora = new DateTime();
    $nascimento = new DateTime($data_nascimento);
    $intervalo = $nascimento->diff($agora);
    return $intervalo->y;
}
?>
