<?php
/***********************************************************************************************************************
 * Função que encerra o login. Logout.
 * Desenvolvedor: Diego Jardim da Silva
 * Data: 12 de agosto de 2024
 */
/***** Deve iniciar a sessão, abrindo a mesma */
session_start();
/***** Verificar se as sessões estão com valores */
if(isset($_SESSION['nome']) and isset($_SESSION['senha'])){
    unset($_SESSION['nome']);
    unset($_SESSION['senha']);
    header('Location: /supermarket/index.php');
}
?>