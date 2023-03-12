<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cadastro de Clientes</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container">
		<h1 class="text-center mb-4">Cadastro de Clientes</h1>
		<form action="cadastrar.php" method="POST">
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
				<label for="nascimento">Data de Nascimento:</label>
				<input type="date" class="form-control" id="nascimento" name="nascimento" required>
			</div>
			<div class="form-group">
				<label for="cep">CEP:</label>
				<input type="text" class="form-control" id="cep" name="cep" required>
			</div>
			<div class="form-group">
				<label for="endereco">Endereço:</label>
				<input type="text" class="form-control" id="endereco" name="endereco" required>
			</div>
			<div class="form-group">
				<label for="observacoes">Observações:</label>
				<textarea class="form-control" id="observacoes" name="observacoes"></textarea>
			</div>
			<button type="submit" class="btn btn-primary">Cadastrar</button>
		</form>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
