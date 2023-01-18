<?php
 
include_once 'connection.php';

//Recebe dados da requisição
$dados_requisicao = $_REQUEST;

//Lista de colunas na tabela
$cols = [
    0 => 'id',
    1 => 'nome',
    2 => 'salario',
    3 => 'idade'
];

$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM users";

if (!empty($dados_requisicao['search']['value'])) 
{
    $query_qnt_usuarios .= " WHERE id LIKE :id ";
    $query_qnt_usuarios .= " OR nome LIKE :nome ";
    $query_qnt_usuarios .= " OR salario LIKE :salario ";
    $query_qnt_usuarios .= " OR idade LIKE :idade "; 
}

$result_qnt_usuarios = $connector->prepare($query_qnt_usuarios);

if (!empty($dados_requisicao['search']['value'])) 
{
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_usuarios->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
}

$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);
 
$query_users = "SELECT id, nome, salario, idade 
                FROM users";

//Verificar os parâmetros de pesquisa 
if (!empty($dados_requisicao['search']['value'])) 
{
    $query_users .= " WHERE id LIKE :id ";
    $query_users .= " OR nome LIKE :nome ";
    $query_users .= " OR salario LIKE :salario ";
    $query_users .= " OR idade LIKE :idade ";
}

//Ordernar os registros
$query_users .= " ORDER BY ". $cols[$dados_requisicao['order'][0]['column']] . " "
                            . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_users = $connector->prepare($query_users);
$result_users->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_users->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);
// $result_users->execute();

//Acessa os parâmetros de pesquisa
if (!empty($dados_requisicao['search']['value'])) 
{
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_users->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_users->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_users->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
    $result_users->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
}

//Executar a query
$result_users->execute();

while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC))
{
    extract($row_user);
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $salario . " " . $dados_requisicao['order'][0]['dir'];
    $registro[] = $idade;
    $registro[] = "<button type='button' class='btn btn-sm btn-outline-secondary' id='$id' 
                    onclick='registryDetails($id)'>Visualizar</button>
                   <button type='button' class='btn btn-sm btn-outline-primary' id='$id' 
                    onclick='editDetails($id)'> Editar </button>
                   <button type='button' class='btn btn-sm btn-outline-danger' id='$id' 
                    onclick='deleteDetails($id)'> Excluir </button>";
    $dados[] = $registro;    
}

/*Array de informações para o JavaScript*/
$resultado = [
    "draw" => intval($dados_requisicao['draw']),/*Cada requisição envia um número como parâmetro*/
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']),/*Quantidade de registros na base de dados*/
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']),
    "data" => $dados /*Registros retornados de tabela users*/
];

/*Dados em formato de objeto para o JavaScript*/
echo json_encode($resultado);