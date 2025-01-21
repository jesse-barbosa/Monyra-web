<?php session_start();
include_once("../classe/Conexao.php");
include_once("../classe/VerificarLogin.php");
include_once("../classe/TrocarUrl.php");

$login = new VerificarLogin();
if (isset($_SESSION['email']) && ($_SESSION['type_user'] == 1 || $_SESSION['type_user'] == 2)) {
	$_SESSION['nome'];
?>
<!doctype html>
<html lang="pt-br">

<?php include_once("../include/head.php");?>

<body>
    <div class="container-fluid">
        <div class="row d-flex flex-row">
            <div class="col-2 p-0 rounded-5 ">
                <?php include_once("../include/menu.php");?>
            </div>
            <div class="col-10 vh-100 p-0">
                <div class="main my-1 p-2 h-100 rounded-3 bg-white">
                <?php 
                $url = new TrocarUrl();
                $url->trocarUrl(@$_GET["tela"]);
                ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
 }else{
    unset($_SESSION["nome"]);
    unset($_SESSION["senha"]);
    header('Location: /Monyra-web/admin/tela/index.php?tela=');
     }
?>