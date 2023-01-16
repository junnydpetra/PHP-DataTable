$(document).ready(function() {
    $('#users_list').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": 'users_list.php',
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json"
        }
    });
});

const formNewUser = document.getElementById("formCadastraUsuario");
const cadModalClose = new bootstrap.Modal(document.getElementById("cadastraUsuario"));

if (formNewUser) 
{
    formNewUser.addEventListener("submit", async(e) => { 
        e.preventDefault();
        const dadosForm = new FormData(formNewUser);
        //console.log(dadosForm);

        const dados = await fetch("registry.php", {
            method: "POST",
            body: dadosForm
        });
        
        const response = await dados.json();

        console.log(response);

        if (response['status']) 
        {
            document.getElementById("msgAlertCadError").innerHTML = "";
            document.getElementById("msgAlertCadSuccess").innerHTML = response['msg'];
            formNewUser.reset();
            cadModalClose.hide();
            listDataTables = $('#users_list').DataTable();
            listDataTables.drawf();
        } else {
            document.getElementById("msgAlertCadError").innerHTML = response['msg'];
        }
    });
}