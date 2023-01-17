<?php

    include_once 'connection.php';

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    if(empty($dados['id']))
    {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    Erro: <b>Tente novamente mais tarde!</b>
                                                </div>"];
    } elseif(empty($dados['nome'])) {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    Erro: <b>Informe um nome válido!</b>
                                                </div>"];
    } elseif(empty($dados['salario'])) {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    Erro: <b>Informe um salário válido!</b>
                                                </div>"];
    } elseif(empty($dados['idade'])) {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    Erro: <b>Informe uma idade válida!</b>
                                                </div>"];
    } else {
        $userEditQuery = "UPDATE users SET nome=:nome, salario=:salario, idade=:idade WHERE id=:id";
        $userEdit = $connector->prepare($userEditQuery);
        $userEdit->bindParam(':nome', $dados['nome']);
        $userEdit->bindParam(':salario', $dados['salario']);
        $userEdit->bindParam(':idade', $dados['idade']);
        $userEdit->bindParam(':id', $dados['id']);

        if ($userEdit->execute()) 
        {
            $return = ['status' => true, 'msg' => "<div class='alert alert-success text-center' role='alert'>
                                                        <b>Dados atualizados!</b>
                                                    </div>"];
        } else {
            $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                        <b>Falha ao atualizar dados! Tente novamente mais tarde.</b>
                                                    </div>"];
        }

    } 

    echo json_encode($return);
    