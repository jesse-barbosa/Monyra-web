<?php
include_once("Conexao.php");

class Alterar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    // Função para alterar os dados de um usuário
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
                echo "<script>alert('Usuário atualizado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario'</script>";
            } else {
                echo "Erro ao atualizar usuário: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // Função para alterar os dados de uma transferência
    public function alterarTransferencia($idTransferencia, $valueTransaction, $descTransaction, $typeTransaction, $categoryTransaction, $userCod) {
        try {
            $sql = "UPDATE tbtransactions SET valueTransaction = ?, descTransaction = ?, typeTransaction = ?, categoryTransaction = ?, userCod = ? WHERE codTransaction = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("dsssii", $valueTransaction, $descTransaction, $typeTransaction, $categoryTransaction, $userCod, $idTransferencia);
    
            if ($stmt->execute()) {
                echo "<script>alert('Transferência atualizada com sucesso!');window.location.href = 'index.php?tela=cadListarTransferencias'</script>";
            } else {
                echo "Erro ao atualizar transferência: " . $stmt->error;
            }
    
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    

    // Função para alterar os dados de uma meta
    public function alterarMeta($idMeta, $nameGoal, $categoryGoal, $descGoal, $amountSaved, $amountRemaining, $userCod) {
        try {
            $sql = "UPDATE tbgoals SET nameGoal = ?, categoryGoal = ?, descGoal = ?, amountSaved = ?, amountRemaining = ?, userCod = ? WHERE codGoal = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("sssdisi", $nameGoal, $categoryGoal, $descGoal, $amountSaved, $amountRemaining, $userCod, $idMeta);

            if ($stmt->execute()) {
                echo "<script>alert('Meta atualizada com sucesso!');window.location.href = 'index.php?tela=cadListarMetas'</script>";
            } else {
                echo "Erro ao atualizar meta: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
