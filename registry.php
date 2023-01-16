<?php

include_once "connection.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])) 
{
    $dataReturn = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    <b>Preencha um nome válido!</b>
                                                </div>"];
} else if (empty($dados['salario'])) {
    $dataReturn = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    <b>Informe o salário!</b>
                                                </div>"];
} else if (empty($dados['idade'])) {
    $dataReturn = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    <b>Informe a idade!</b>
                                                </div>"];
} else {
    $query_user = "INSERT INTO users (nome, salario, idade) VALUE (:nome, :salario, :idade)";
    $cad_usuario = $connector->prepare($query_user);
    $cad_usuario->bindParam(':nome', $dados['nome']);
    $cad_usuario->bindParam(':salario', $dados['salario']);
    $cad_usuario->bindParam(':idade', $dados['idade']);
    $cad_usuario->execute();

    if ($cad_usuario->rowCount()) {
        $dataReturn = ['status' => true, 'msg' => "<div class='alert alert-success text-center' role='alert'>
                                                        <b>Usuário cadastrado com sucesso!
                                                    </div>"];
    } else {
        $dataReturn = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                        <b>Erro: Falha ao cadastrar usuário!</b>
                                                    </div>"];
    }
}

echo json_encode($dataReturn);