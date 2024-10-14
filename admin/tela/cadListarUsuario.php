<?php
// Adicionar
include_once("../classe/AdicionarItem.php");

if (isset($_POST['enviar'])) {
    $nameUser = $_POST['nameUser'];
    $emailUser = $_POST['emailUser'];
    $passwordUser = password_hash($_POST['passwordUser'], PASSWORD_DEFAULT);  // Hash da senha
    $descUser = $_POST['descUser'];
    $incomeUser = $_POST['incomeUser'];
    $balanceUser = $_POST['balanceUser'];
    $iconUser = $_POST['iconUser'];
    $type_user = $_POST['type_user'];

    $usuario = new Adicionar();
    $usuario->adicionarUsuario($nameUser, $emailUser, $passwordUser, $descUser, $incomeUser, $balanceUser, $iconUser, $type_user);
}

// Editar
include_once("../classe/AlterarItem.php");

if (isset($_POST['editar'])) {
    $codUser = $_POST['codUser'];
    $nameUser = $_POST['nameUser'];
    $emailUser = $_POST['emailUser'];
    $passwordUser = $_POST['passwordUser'];
    $descUser = $_POST['descUser'];
    $incomeUser = $_POST['incomeUser'];
    $balanceUser = $_POST['balanceUser'];
    $iconUser = $_POST['iconUser'];
    $type_user = $_POST['type_user'];

    $usuario = new Alterar();
    $usuario->alterarUsuario($codUser, $nameUser, $emailUser, $passwordUser, $descUser, $incomeUser, $balanceUser, $iconUser, $type_user);
}

// Apagar
include_once("../classe/ApagarItem.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idUsuario'])) {
    $codUser = intval($_GET['idUsuario']);
    $apagarUsuario = new Apagar();
    $apagarUsuario->apagarUsuario($codUser);
}
?>


<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3 fw-medium">Usuários Cadastrados</div>
            </div>
            <div class="col-3 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Mostrar dados -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col bg-white py-4 m-3 rounded-3">
                <?php
                    include_once("../classe/MostrarItem.php");
                    $usuarios = new Mostrar();
                    $usuarios->setNumPagina(@$_GET['pg']);
                    $usuarios->setUrl("?tela=cadListarUsuario");
                    $usuarios->setSessao('');
                    $usuarios->mostrarUsuario();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Paginação -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <ul class="nav d-flex">
                    <li><?php $usuarios->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Novo Usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarUsuario" method="post" enctype="multipart/form-data">
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="nameUser" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nameUser" name="nameUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailUser" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailUser" name="emailUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordUser" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="passwordUser" name="passwordUser">
                    </div>
                    <div class="mb-3">
                        <label for="descUser" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descUser" name="descUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="incomeUser" class="form-label">Renda</label>
                        <input type="text" class="form-control" id="incomeUser" name="incomeUser">
                    </div>
                    <div class="mb-3">
                        <label for="balanceUser" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="balanceUser" name="balanceUser" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="iconUser" class="form-label">Ícone</label>
                        <input type="text" class="form-control" id="iconUser" name="iconUser">
                    </div>
                    <div class="mb-3">
                        <label for="type_user" class="form-label">Tipo</label>
                        <select class="form-select" id="type_user" name="type_user" required>
                            <option value='0'>Default</option>
                            <option value='1'>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="enviar" class="btn btn-dark form-control">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarUsuario" method="post" enctype="multipart/form-data" id="editUserForm">
                <div class="modal-body">
                    <input type="hidden" name="codUser" id="editCodUser">
                    <div class="mb-3">
                        <label for="editNameUser" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNameUser" name="nameUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmailUser" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmailUser" name="emailUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPasswordUser" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="editPasswordUser" name="passwordUser">
                    </div>
                    <div class="mb-3">
                        <label for="editDescUser" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescUser" name="descUser" required>
                    </div>
                    <div class="mb-3">
                        <label for="editIncomeUser" class="form-label">Renda</label>
                        <input type="text" class="form-control" id="editIncomeUser" name="incomeUser">
                    </div>
                    <div class="mb-3">
                        <label for="editBalanceUser" class="form-label">Saldo</label>
                        <input type="number" class="form-control" id="editBalanceUser" name="balanceUser" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="editIconUser" class="form-label">Ícone</label>
                        <input type="text" class="form-control" id="editIconUser" name="iconUser">
                    </div>
                    <div class="mb-3">
                        <label for="editTypeUser" class="form-label">Tipo</label>
                        <select class="form-select" id="editTypeUser" name="type_user" required>
                            <option value='0'>Default</option>
                            <option value='1'>Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark form-control">Salvar Alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este Usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark" id="confirmDelete">Excluir</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('editCodUser').value = this.dataset.coduser;
            document.getElementById('editNameUser').value = this.dataset.nameuser;
            document.getElementById('editEmailUser').value = this.dataset.emailuser;
            document.getElementById('editDescUser').value = this.dataset.descuser;
            document.getElementById('editIncomeUser').value = this.dataset.incomeuser;
            document.getElementById('editBalanceUser').value = this.dataset.balanceuser;
            document.getElementById('editIconUser').value = this.dataset.iconuser;
            document.getElementById('editTypeUser').value = this.dataset.typeuser;

            const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        });
    });

    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId) {
            window.location.href = 'index.php?tela=cadListarUsuario&action=delete&idUsuario=' + deleteId;
        }
    });
});

</script>