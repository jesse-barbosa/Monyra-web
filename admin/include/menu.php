<div class="menu d-flex flex-column h-100">
        <div class="d-flex flex-row text-center">
            <div class="text-center my-0 mb-3 lead text-light">
                <img src="../img/icon.png" class="rounded-3 mb-1 w-50" alt="Icone">
                <p class='fw-normal text-dark fs-5'><?php echo $_SESSION['nome']; ?></p>
            </div>
        </div>
    <ul class="nav flex-column flex-grow-1">
        <a class="menu-link <?php echo ($_GET['tela'] == 'home') ? 'active' : ''; ?>" href="?tela=home"><li class="nav-item"> 
            <i class="bi bi-house"></i> Início
        </li></a>
        <a class="menu-link <?php echo ($_GET['tela'] == 'cadListarUsuario') ? 'active' : ''; ?>" href="?tela=cadListarUsuario"><li class="nav-item"> 
            <i class="bi bi-people"></i> Usuários
        </li></a>
        <a class="menu-link <?php echo ($_GET['tela'] == 'cadListarTransferencias') ? 'active' : ''; ?>" href="?tela=cadListarTransferencias"><li class="nav-item"> 
            <i class="bi bi-currency-exchange"></i> Transações
        </li></a>
        <a class="menu-link <?php echo ($_GET['tela'] == 'cadListarMetas') ? 'active' : ''; ?>" '" href="?tela=cadListarMetas">
            <li class="nav-item"> 
                <i class="bi bi-bookmark"></i> Metas
            </li>
        </a>
    </ul>
    <ul class="nav flex-column">
        <a class="menu-link mt-auto" href="../../admin/funcao/Sair.php"><li class="nav-item"> 
            <i class="bi bi-door-open"></i> Sair
        </li></a>
    </ul>
</div>
