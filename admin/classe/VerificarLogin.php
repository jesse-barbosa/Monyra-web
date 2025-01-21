<?php
/***********************************************************************************************************************
 * Classe que irá permitir ou negar o acesso ao painel de administrador.
 * Desenvolvedor: Jessé Barbosa
 * Data: 30 de Setembro de 2024
 */
include_once("Conexao.php");
class VerificarLogin extends Conexao{
public function verificarLogin($email, $senha) {
    try {
        // Consulta apenas o email e o hash da senha, sem incluir a senha diretamente
        $sql = "SELECT * FROM tbusers WHERE emailUser = '$email' AND type_user = '1'";
        $query = self::execSql($sql);
        $resultado = self::listarDados($query);
        $dados = self::contarDados($query);

        if($dados <= 0) {
            echo "<div class='alert alert-danger mt-3'>Email ou senha inválidos.</div>";
        } else {
            // Verifica o hash da senha armazenada no banco de dados com a senha fornecida
            $hashSenha = $resultado[0]['passwordUser'];
            if (password_verify($senha, $hashSenha)) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $resultado[0]['nameUser'];
                $_SESSION['type_user'] = $resultado[0]['type_user'];

                header('Location: /Monyra-web/admin/tela/index.php?tela=');
            } else {
                echo "<div class='alert alert-danger mt-3'>Email ou senha inválidos.</div>";
            }
        }
    } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
    }   
}

}