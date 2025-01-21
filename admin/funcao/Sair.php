<?php
/***********************************************************************************************************************
 * Função que encerra a sessão.
 * Desenvolvedor: Jessé Barbosa Moreira
 * Data: 21 de Janeiro de 2025
 */
/***** Deve iniciar a sessão, abrindo a mesma */
session_start();
/***** Verificar se as sessões estão com valores */
if(isset($_SESSION['nome']) and isset($_SESSION['email'])){
    unset($_SESSION['nome']);
    unset($_SESSION['email']);
    unset($_SESSION['type_user']);
    header('Location: /Monyra-web/index.php');
}
?>