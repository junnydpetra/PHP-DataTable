<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css ">

        <title>PHP + DataTable</title>
    </head>

    <body>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
                <h1 class="display-5 mb-4">Lista de Usuários</h1>
                
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" 
                data-bs-target="#cadastraUsuario">
                    Cadastrar
                </button>
            </div>

            <span id="msgAlertCadSuccess"></span>
            
            <table id="users_list" class="table table-hover table-striped display" style="width:100%">
                <thead>
                    <tr>
                        <th>Registro</th>
                        <th>Nome</th>
                        <th>Salário</th>
                        <th>Idade</th>
                    </tr>
                </thead>
            </table> 
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cadastraUsuario" tabindex="-1" aria-labelledby="cadastraUsuarioLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="d-flex justify-content-between align-items-center p-2 pb-0">
                        <h1 class="text-center fs-5" id="cadastraUsuarioLabel">Cadastrar Usuário</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <span id="msgAlertCadError"></span>
                        
                        <form method="POST" id="formCadastraUsuario">

                            <div class="row mb-3">
                                <label for="nome" class="col-sm-2 col-form-label"><b>Nome</b>:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="nome" class="form-control" id="nome"
                                           placeholder="Nome completo">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="salario" class="col-sm-2 col-form-label"><b>Salário</b>:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="salario" class="form-control" id="salario"
                                           placeholder="Informe o salário">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="idade" class="col-sm-2 col-form-label"><b>Idade</b>:</label>
                                <div class="col-sm-10">
                                    <input type="number" name="idade" class="form-control" id="idade"
                                           placeholder="Informe a idade">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-sm btn-outline-success float-end" 
                                    value="Enviar">Enviar</button>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
            
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

        <script src="js/custom.js"></script>
    </body>
</html>