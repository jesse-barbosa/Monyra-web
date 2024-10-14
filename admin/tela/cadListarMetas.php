<?php
// Adicionar metas
include_once("../classe/AdicionarItem.php");

if (isset($_POST['enviar'])) {
    $nameGoal = $_POST['nameGoal'];
    $categoryGoal = $_POST['categoryGoal'];
    $descGoal = $_POST['descGoal'];
    $amountSaved = $_POST['amountSaved'];
    $totalGoal = $_POST['totalGoal'];
    $userCod = $_POST['userCod'];

    $Metas = new Adicionar();
    $Metas->adicionarMeta($nameGoal, $categoryGoal, $descGoal, $amountSaved, $totalGoal, $userCod);
}

// Editar
include_once("../classe/AlterarItem.php");

if (isset($_POST['editar'])) {
    $codGoal = $_POST['codGoal'];
    $nameGoal = $_POST['nameGoal'];
    $categoryGoal = $_POST['categoryGoal'];
    $descGoal = $_POST['descGoal'];
    $amountSaved = $_POST['amountSaved'];
    $amountRemaining = $_POST['amountRemaining'];
    $userCod = $_POST['userCod'];

    $Metas = new Alterar();
    $Metas->alterarMeta($codGoal, $nameGoal, $categoryGoal, $descGoal, $amountSaved, $amountRemaining, $userCod);
}

// Apagar
include_once("../classe/ApagarItem.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['codGoal'])) {
    $codGoal = intval($_GET['codGoal']);
    $apagarMetas = new Apagar();
    $apagarMetas->apagarMeta($codGoal);
}
?>

<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3 fw-medium">Metas Cadastrados</div>
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
                    $metas = new Mostrar();
                    $metas->setNumPagina(@$_GET['pg']);
                    $metas->setUrl("?tela=cadListarMetas");
                    $metas->setSessao('');
                    $metas->mostrarMetas();
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
                    <li><?php $metas->geraNumeros();?></li>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar Meta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarMetas" method="post" enctype="multipart/form-data">
                <div class="modal-body text-start">
                    <div class="mb-3">
                        <label for="nameGoal" class="form-label">Nome da Meta</label>
                        <input type="text" class="form-control" id="nameGoal" name="nameGoal" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryGoal" class="form-label">Categoria</label>
                        <select class="form-select" id="categoryGoal" name="categoryGoal" required>
                            <option value="">Selecione uma categoria</option>
                            <option value="Moradia">Moradia</option>
                            <option value="Alimentação">Alimentação</option>
                            <option value="Transporte">Transporte</option>
                            <option value="Saúde">Saúde</option>
                            <option value="Educação">Educação</option>
                            <option value="Lazer">Lazer</option>
                            <option value="Vestuário">Vestuário</option>
                            <option value="Economia">Economia ou Investimentos</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="descGoal" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descGoal" name="descGoal">
                    </div>
                    <div class="mb-3">
                        <label for="amountSaved" class="form-label">Valor Economizado</label>
                        <input type="number" class="form-control" id="amountSaved" name="amountSaved" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalGoal" class="form-label">Valor Total</label>
                        <input type="number" class="form-control" id="totalGoal" name="totalGoal" required>
                    </div>
                    <div class="mb-3">
                        <label for="userCod" class="form-label">Código do Usuário</label>
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
<div class="modal fade" id="editGoalModal" tabindex="-1" aria-labelledby="editGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGoalModalLabel">Editar Meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarMetas" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="codGoal" id="editCodGoal">
                    <div class="mb-3">
                        <label for="editNameGoal" class="form-label">Nome da Meta</label>
                        <input type="text" class="form-control" id="editNameGoal" name="nameGoal" required>
                    </div>
                    <div class="mb-3">
                    <label for="editCategoryGoal" class="form-label">Categoria</label>
                    <select class="form-select" id="editCategoryGoal" name="categoryGoal" required>
                        <option value="">Selecione uma categoria</option>
                        <option value="Moradia">Moradia</option>
                        <option value="Alimentação">Alimentação</option>
                        <option value="Transporte">Transporte</option>
                        <option value="Saúde">Saúde</option>
                        <option value="Educação">Educação</option>
                        <option value="Lazer">Lazer</option>
                        <option value="Vestuário">Vestuário</option>
                        <option value="Economia">Economia ou Investimentos</option>

                    </select>
                </div>
                    <div class="mb-3">
                        <label for="editDescGoal" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescGoal" name="descGoal">
                    </div>
                    <div class="mb-3">
                        <label for="editAmountSaved" class="form-label">Valor Economizado</label>
                        <input type="number" class="form-control" id="editAmountSaved" name="amountSaved" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTotalGoal" class="form-label">Valor Total</label>
                        <input type="number" class="form-control" id="editTotalGoal" name="totalGoal" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserCod" class="form-label">Código do Usuário</label>
                        <input type="number" class="form-control" id="editUserCod" name="userCod" required>
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
                Tem certeza de que deseja excluir esta Meta?
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
    // Ação de editar metas
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            // Preenche o formulário de edição com os dados da meta
            document.getElementById('editCodGoal').value = this.dataset.id;
            document.getElementById('editNameGoal').value = this.dataset.name;
            document.getElementById('editCategoryGoal').value = this.dataset.category;
            document.getElementById('editDescGoal').value = this.dataset.desc;
            document.getElementById('editAmountSaved').value = this.dataset.saved;
            document.getElementById('editTotalGoal').value = this.dataset.remaining;
            document.getElementById('editUserCod').value = this.dataset.usercod;

            // Exibe o modal de edição
            const editModal = new bootstrap.Modal(document.getElementById('editGoalModal'));
            editModal.show();
        });
    });

    // Ação de confirmar exclusão de metas
    let deleteId = null;
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            // Captura o ID da meta que será excluída
            deleteId = this.dataset.id;

            // Exibe o modal de confirmação de exclusão
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            deleteModal.show();
        });
    });

    // Ação de exclusão confirmada
    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId) {
            // Redireciona para a página de exclusão com o ID da meta
            window.location.href = `index.php?tela=cadListarMetas&action=delete&codGoal=${deleteId}`;
        }
    });
});
</script>