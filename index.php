<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

        <title>PHP + DataTable</title>
    </head>

    <body>
        <h1>Lista de Usuários</h1>
     
        <table id="usersList" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Nome</th>
                    <th>Salário</th>
                    <th>Idade</th>
                </tr>
            </thead>
        </table> 
    
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#usersList').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: 'users_list.php',
                });
            });
        </script>
    </body>
</html>