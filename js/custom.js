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

            document.getElementById("msgAlertCadError").innerHTML = "";
        } else {
            document.getElementById("msgAlertCadError").innerHTML = response['msg'];
        } 
    });
}

async function registryDetails(id) 
{
    const dados = await fetch('toView.php?id=' + id);
    const response = await dados.json();
    console.log(response);

    if(response['status'])
    {
        const toViewUserModal = new bootstrap.Modal(document.getElementById("toViewUser"));
        toViewUserModal.show();

        document.getElementById("userID").innerHTML = response['dados'].id;
        document.getElementById("userName").innerHTML = response['dados'].nome;
        document.getElementById("userWage").innerHTML = response['dados'].salario;
        document.getElementById("userAge").innerHTML = response['dados'].idade;
    } else {
        document.getElementById("msgAlertCadSuccess").innerHTML = response['msg'];
    }

}

// const editDetailsModal = new bootstrap.Modal(document.getElementById("editUser"));

const editUserModal = new bootstrap.Modal(document.getElementById("editUser"));

async function editDetails(id)
{
    const dados = await fetch('toView.php?id=' + id);
    const response = await dados.json();

    if(response['status'])
    {
        document.getElementById("msgAlertEditError").innerHTML = "";
        
        document.getElementById("msgAlertCadSuccess").innerHTML = "";
        editUserModal.show();

        document.getElementById("idEdit").value = response['dados'].id;
        document.getElementById("nomeEdit").value = response['dados'].nome;
        document.getElementById("salarioEdit").value = response['dados'].salario;
        document.getElementById("idadeEdit").value = response['dados'].idade;
    } else {
        document.getElementById("msgAlertCadSuccess").innerHTML = response['msg'];
    }
}

const editUserForm = document.getElementById("formEditUsuario");

if (editUserForm) 
{
    editUserForm.addEventListener("submit", async(e) => {
        e.preventDefault();
        const formDados = new FormData(editUserForm);

        const dados = await fetch("editDetails.php", {
            method: "POST",
            body: formDados
        });

        const response = await dados.json();

        if(response['status'])
        {
            document.getElementById("msgAlertEditError").innerHTML = response['msg'];
        } else {
            document.getElementById("msgAlertEditError").innerHTML = response['msg'];
        }
    });
}

async function deleteDetails(id)
{
    console.log("Excluir usuário ID " + id);
}