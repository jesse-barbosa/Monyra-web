<?php
// Adicionar
include_once("../classe/AdicionarItem.php");

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);  // Hash da senha
    $access_level = $_POST['access_level'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $situacao = $_POST['situacao'];

    $usuario = new Adicionar();
    $usuario->adicionarUsuario($nome, $email, $senha, $access_level, $cpf, $telefone, $situacao);
}

// Editar
include_once("../classe/AlterarItem.php");

if (isset($_POST['editar'])) {
    $idUsuario = $_POST['idUsuario'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $access_level = $_POST['access_level'];
    $cpf = $_POST['cpf'];
    $phone = $_POST['telefone'];
    $situacao = $_POST['situacao'];

    $usuario = new Alterar();

    $usuario->alterarUsuario($idUsuario, $nome, $email, $senha,  $access_level, $cpf, $phone, $situacao);

}

// Apagar
include_once("../classe/ApagarItem.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idUsuario'])) {
    $idUsuario = intval($_GET['idUsuario']);
    $apagarUsuario = new Apagar();
    $apagarUsuario->apagarUsuario($idUsuario);
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo
                    item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarUsuario" method="post" enctype="multipart/form-data">
            <div class="modal-body text-start">
                <div class="mb-3">
                    <label for="nomeUsuario" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeUsuario" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="emailUsuario" class="form-label">Email</label>
                    <input type="email" class="form-control" id="emailUsuario" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="senhaUsuario" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senhaUsuario" name="senha">
                </div>
                <div class="mb-3">
                    <label for="access_levelUser" class="form-label">Tipo</label>
                    <select class="form-select" id="access_level" name="access_level" required>
                        <option value='0'>Default</option>
                        <option value='1'>Admin</option>
                        <option value='2'>Admin-Master</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="cpfUsuario" class="form-label">CPF</label>
                    <input type="number" class="form-control" id="cpfUsuario" name="cpf">
                </div>
                <div class="mb-3">
                    <label for="telefoneUsuario" class="form-label">Telefone</label>
                    <input type="number" class="form-control" id="phoneUsuario" name="telefone">
                </div>
                <div class="mb-3">
                    <label for="situacaoUsuario" class="form-label">Situação</label>
                    <select class="form-select" id="situacaoUsuario" name="situacao" required>
                        <option value='ATIVO'>ATIVO</option>
                        <option value='DESATIVO'>DESATIVO</option>
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
                    <input type="hidden" name="idUsuario" id="editIdUsuario">
                    <div class="mb-3">
                        <label for="editNomeUsuario" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNomeUsuario" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editEmailUsuario" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmailUsuario" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editSenhaUsuario" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="editSenhaUsuario" name="senha">
                    </div>
                    <div class="mb-3">
                        <label for="editAccessLevel" class="form-label">Tipo</label>
                        <select class="form-select" id="editAccessLevel" name="access_level" required>
                            <option value='0'>Default</option>
                            <option value='1'>Admin</option>
                            <option value='2'>Admin-Master</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editCPFUsuario" class="form-label">CPF</label>
                        <input type="number" class="form-control" id="editCpfUsuario" name="cpf">
                    </div>
                    <div class="mb-3">
                        <label for="editTelefoneUsuario" class="form-label">Telefone</label>
                        <input type="number" class="form-control" id="editTelefoneUsuario" name="telefone">
                    </div>
                    <div class="mb-3">
                        <label for="editSituacaoUsuario" class="form-label">Situação</label>
                        <select class="form-select" id="editSituacaoUsuario" name="situacao" required>
                            <option value='ATIVO'>ATIVO</option>
                            <option value='DESATIVO'>DESATIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark form-control">Salvar alterações</button>
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
            console.log('Tipo:', this.dataset.type);
            document.getElementById('editIdUsuario').value = this.dataset.id;
            document.getElementById('editNomeUsuario').value = this.dataset.nome;
            document.getElementById('editEmailUsuario').value = this.dataset.email;
            document.getElementById('editCpfUsuario').value = this.dataset.cpf;
            document.getElementById('editTelefoneUsuario').value = this.dataset.phone;
            document.getElementById('editAccessLevel').value = this.dataset.accesslevel;
            document.getElementById('editSituacaoUsuario').value = this.dataset.situacao;

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