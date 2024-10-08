<?php
// Adicionar
include_once("../classe/AdicionarItem.php");

if (isset($_POST['enviar'])) {
    $value = $_POST['valueTransaction'];
    $desc = $_POST['descTransaction'];
    $type = $_POST['typeTransaction'];
    $category = $_POST['categoryTransaction'];
    $userCod = $_POST['userCod'];

    $transferencias = new Adicionar();
    $transferencias->adicionarTransferencias($value, $desc, $type, $category, $userCod);
}

// Editar
include_once("../classe/AlterarItem.php");

if (isset($_POST['editar'])) {
    $codTransaction = $_POST['codTransaction'];
    $value = $_POST['valueTransaction'];
    $desc = $_POST['descTransaction'];
    $type = $_POST['typeTransaction'];
    $category = $_POST['categoryTransaction'];

    $transferencias = new Alterar();
    $transferencias->alterarTransferencias($codTransaction, $value, $desc, $type, $category);
}

// Apagar
include_once("../classe/ApagarItem.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['codTransaction'])) {
    $codTransaction = intval($_GET['codTransaction']);
    $apagarTransferencias = new Apagar();
    $apagarTransferencias->apagarTransferencias($codTransaction);
}
?>

<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3 fw-medium">Transferências Cadastrados</div>
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
<!-- Mostrar dados das Transferências -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col bg-white py-4 m-3 rounded-3">
                <?php
                    include_once("../classe/MostrarItem.php");
                    $transferencias = new Mostrar();
                    $transferencias->setNumPagina(@$_GET['pg']);
                    $transferencias->setUrl("?tela=cadListarTransferencias");
                    $transferencias->setSessao('');
                    $transferencias->mostrarTransferencias();
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
                    <li><?php $transferencias->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar nova Transferência</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarTransferencias" method="post" enctype="multipart/form-data">
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="valueTransaction" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="valueTransaction" name="valueTransaction" required>
                    </div>
                    <div class="mb-3">
                        <label for="descTransaction" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descTransaction" name="descTransaction" required>
                    </div>
                    <div class="mb-3">
                        <label for="typeTransaction" class="form-label">Tipo</label>
                        <select class="form-select" id="typeTransaction" name="typeTransaction" required>
                            <option value="Entrada">Entrada</option>
                            <option value="Saída">Saída</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categoryTransaction" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="categoryTransaction" name="categoryTransaction" required>
                    </div>
                    <div class="mb-3">
                        <label for="userCod" class="form-label">Usuário</label>
                        <input type="number" class="form-control" id="userCod" name="userCod" required>
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
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTransactionModalLabel">Editar Transferência</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarTransferencias" method="post" enctype="multipart/form-data" id="editTransactionForm">
                <div class="modal-body">
                    <input type="hidden" name="codTransaction" id="editCodTransaction">
                    <div class="mb-3">
                        <label for="editValueTransaction" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="editValueTransaction" name="valueTransaction" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescTransaction" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescTransaction" name="descTransaction" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTypeTransaction" class="form-label">Tipo</label>
                        <select class="form-select" id="editTypeTransaction" name="typeTransaction" required>
                            <option value="expense">Gasto</option>
                            <option value="gain">Ganho</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryTransaction" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="editCategoryTransaction" name="categoryTransaction" required>
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
                Tem certeza de que deseja excluir esta Transferência?
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
    // Edição de Transferências
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('editCodTransaction').value = this.dataset.id;
            document.getElementById('editValueTransaction').value = this.dataset.value;
            document.getElementById('editDescTransaction').value = this.dataset.desc;
            document.getElementById('editTypeTransaction').value = this.dataset.type;
            document.getElementById('editCategoryTransaction').value = this.dataset.category;

            const modal = new bootstrap.Modal(document.getElementById('editTransactionModal'));
            modal.show();
        });
    });

    // Exclusão de Transferências
    let deleteId = null;
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId) {
            window.location.href = 'index.php?tela=cadListarTransferencias&action=delete&codTransaction=' + deleteId;
        }
    });
});
</script>