const express = require('express');
const app = express();
const port = 3000;
const path = require('path');
const bodyParser = require('body-parser');
const { v4: uuidv4 } = require('uuid');
const axios = require('axios');
const xlsx = require('xlsx');
const fs = require('fs');

// Configurando o body parser
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Configurando a pasta public como a pasta de arquivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Configurando a rota principal
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'public', 'index.html'));
});

// Configurando a rota para cadastrar um novo cliente
app.post('/clientes', (req, res) => {
  // Buscando o endereço do cliente a partir do CEP usando a API do ViaCEP
  axios.get(`https://viacep.com.br/ws/${req.body.cep}/json/`).then((response) => {
    // Criando um objeto com os dados do cliente
    const cliente = {
      id: uuidv4(),
      nome: req.body.nome,
      sobrenome: req.body.sobrenome,
      rg: req.body.rg,
      cpf: req.body.cpf,
      email: req.body.email,
      nascimento: req.body.nascimento,
      idade: calcularIdade(req.body.nascimento),
      cep: req.body.cep,
      endereco: `${response.data.logradouro}, ${response.data.bairro}, ${response.data.localidade}, ${response.data.uf}`,
      observacoes: req.body.observacoes,
    };

    // Salvando o cliente no banco de dados
    salvarCliente(cliente);

    res.redirect('/');
  });
});

// Configurando a rota para buscar um cliente pelo ID
app.get('/clientes/:id', (req, res) => {
  const cliente = buscarCliente(req.params.id);

  if (cliente) {
    res.json(cliente);
  } else {
    res.sendStatus(404);
  }
});

// Configurando a rota para buscar todos os clientes
app.get('/clientes', (req, res) => {
  const clientes = buscarTodosClientes();

  res.json(clientes);
});

// Configurando a rota para importar uma tabela de clientes em formato Excel
app.post('/clientes/importar', (req, res) => {
  if (!req.files || !req.files.arquivo) {
    res.status(400).send('Nenhum arquivo foi enviado.');
    return;
  }

  const arquivo = req.files.arquivo;

  // Lendo o arquivo Excel
  const workbook = xlsx.read(arquivo.data);

  // Obtendo a primeira planilha
  const sheet = workbook.Sheets[workbook.SheetNames[0]];

  // Convertendo a planilha para um array de objetos
  const data = xlsx.utils.sheet_to_json(sheet);

  // Salvando todos os clientes no banco de dados
  data.forEach((cliente) => {
    salvarCliente(cliente);
  });

  res.redirect('/');
});

// Configurando a rota para exportar a tabela de clientes em formato Excel
app.get('/clientes/exportar', (req, res) => {
  const clientes = buscarTodosClientes();

  // Criando um workbook do Excel
  const workbook = xlsx.utils.book_new();

  // Criando uma worksheet com os clientes
  const worksheet = xlsx.utils.json_to_sheet(clientes);

 
