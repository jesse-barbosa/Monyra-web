<?php
include_once("Conexao.php");
class VerificarLogin extends Conexao{
    public function verificarLogin($email, $senha){
     try {
        $sql = "SELECT * FROM tbusers WHERE emailUser = '$email' AND passwordUser = '$senha' AND statusUser = 'ativo'";
        $query = self::execSql($sql);
        $resultado = self::listarDados($query);
        $dados = self::contarDados($query);
        
        if($dados <= 0){
            echo "Email ou senha inválidos.";
        }else if($dados == 1){
            session_start();
            $_SESSION['nome'] = $email;
            $_SESSION['id'] = $resultado[0]['codUser'];
            $_SESSION['senha'] = $senha;
            
            echo "<script>window.location.href = 'tela/index.php?tela=home'</script>";
        }
     } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
     }   
    }
}