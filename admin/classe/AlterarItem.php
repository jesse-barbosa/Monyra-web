<?php
include_once("Conexao.php");
include_once("UploadImagem.php");

class Alterar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    // Função para alterar os dados de um produto
    public function alterarUsuario($idUsuario, $name, $email, $senha = null, $description, $income, $balance, $icon, $type) {
        try {
            if ($senha) {
                $sql = "UPDATE tbusers SET nameUser = ?, emailUser = ?, passwordUser = ?, descUser = ?, incomeUser = ?, balanceUser = ?, iconUser = ?, type_user = ? WHERE codUser = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("sssssdsii", $name, $email, $senha, $description, $income, $balance, $icon, $type, $idUsuario);
            } else {
                $sql = "UPDATE tbusers SET nameUser = ?, emailUser = ?, descUser = ?, incomeUser = ?, balanceUser = ?, iconUser = ?, type_user = ? WHERE codUser = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssssdsii", $name, $email, $description, $income, $balance, $icon, $type, $idUsuario);
            }

            if ($stmt->execute()) {
                // Sucesso ao alterar usuário
            } else {
                echo "Erro ao atualizar usuário: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
