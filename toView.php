<?php

    include_once 'connection.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id))
    {
        $query_user = "SELECT id, nome, salario, idade FROM users WHERE id=:id LIMIT 1"; 
        $user_result = $connector->prepare($query_user);
        $user_result->bindParam(':id', $id);
        $user_result->execute();
        
        if (($user_result) and ($user_result->rowCount() != 0)) 
        {
            $user_row = $user_result->fetch(PDO::FETCH_ASSOC);
            $return = ['status' => true, 'dados' => $user_row];
        } else {
            $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                        Erro: <b>Nenhum usuário encontrado 1!</b>
                                                    </div>"];
        }
    } else {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    Erro: <b>Nenhum usuário encontrado 2!</b>
                                                </div>"];
    } 

    echo json_encode($return);
    