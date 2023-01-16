<?php
 
include_once './connection.php';

//Recebe dados da requisição
$dados_requisicao = $_REQUEST;

$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM users";
$result_qnt_usuarios = $connector->prepare($query_qnt_usuarios);
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);

$query_users = "SELECT id, nome, salario, idade 
                FROM users
                ORDER BY id DESC";

$result_users = $connector->prepare($query_users);
$result_users->execute();

while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC))
{
    extract($row_user);
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $salario;
    $registro[] = $idade;
    $dados[] = $registro;
    
}

//echo "<pre>";
//print_r($dados);
//echo "</pre>";

//Array de informações para o JavaScript
$resultado = [
    "draw" => intval($dados_requisicao['draw']),//Cada requisição envia um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']),//Quantidade de registros na base de dados
    "recordFiltered" => intval($row_qnt_usuarios['qnt_usuarios']),//Total de registros por pesquisa
    "data" => $dados //Registros retornados de tabela users
];

//echo "<pre>";
//print_r($resultado);
//echo "</pre>";

//Dados em formato de objeto para o JavaScript
echo json_encode($resultado);