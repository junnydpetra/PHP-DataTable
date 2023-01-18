<?php

    include_once 'connection.php';

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

    if(!empty($id))
    {
        $query_delete_user = "DELETE FROM users WHERE id=:id";
        $user_result = $connector->prepare($query_delete_user);
        $user_result->bindParam(":id", $id, PDO::PARAM_INT);

        if($user_result->execute())
        {
            $return = ['status' => true, 'msg' => "<div class='alert alert-success text-center' role='alert'>
                                                        <b>Registro excluído!</div>"];
        } else {
            $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                        <b>Falha ao excluir registro!</div>"];
        }

    } else {
        $return = ['status' => false, 'msg' => "<div class='alert alert-danger text-center' role='alert'>
                                                    <b>Falha ao excluir registro!</div>"];
    } 

    echo json_encode($return);
    