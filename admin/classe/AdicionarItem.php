<?php
include_once("Conexao.php");

class Adicionar extends Conexao {

    public function __construct(){
        parent::__construct();
    }

    // Adicionar usuário
    public function adicionarUsuario($nameUser, $emailUser, $passwordUser, $descUser, $incomeUser, $balanceUser, $iconUser, $type_user){
        try {
            $sql = "INSERT INTO tbusers (nameUser, emailUser, passwordUser, descUser, incomeUser, balanceUser, iconUser, typeUser)
                    VALUES ('$nameUser', '$emailUser', '$passwordUser', '$descUser', '$incomeUser', '$balanceUser', '$iconUser', '$type_user')";
            if ($this->execSql($sql)) {
                echo "<script>alert('Usuário adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario'</script>";
            } else {
                echo "Erro ao executar a SQL: " . $sql;
            }
        } catch (Exception $e) {
            echo "Erro ao adicionar Usuário: " . $e->getMessage();
        }
    }

    // Adicionar transferência
    public function adicionarTransferencia($valueTransaction, $descTransaction, $typeTransaction, $categoryTransaction, $userCod) {
        try {
            $sql = "INSERT INTO tbtransactions (valueTransaction, descTransaction, typeTransaction, categoryTransaction, userCod) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("dsssi", $valueTransaction, $descTransaction, $typeTransaction, $categoryTransaction, $userCod);

            if ($stmt->execute()) {
                echo "<script>alert('Transferência adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarTransferencias'</script>";
            } else {
                echo "Erro ao adicionar transferência: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // Adicionar meta
public function adicionarMeta($nameGoal, $categoryGoal, $descGoal, $amountSaved, $amountRemaining, $userCod) {
    try {
        // Verificar se o userCod existe na tabela tbusers
        $sqlCheck = "SELECT codUser FROM tbusers WHERE codUser = ?";
        $stmtCheck = $this->getConnection()->prepare($sqlCheck);
        $stmtCheck->bind_param("i", $userCod);
        $stmtCheck->execute();
        $stmtCheck->store_result();

        if ($stmtCheck->num_rows == 0) {
            throw new Exception("Usuário com o codUser $userCod não existe.");
        }
        $stmtCheck->close();

        // Se o usuário existir, inserir a meta
        $sql = "INSERT INTO tbgoals (nameGoal, categoryGoal, descGoal, amountSaved, amountRemaining, userCod)
                VALUES ('$nameGoal', '$categoryGoal', '$descGoal', '$amountSaved', '$amountRemaining', '$userCod')";
        if ($this->execSql($sql)) {
            echo "<script>alert('Meta adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarMetas'</script>";
        } else {
            echo "Erro ao executar a SQL: " . $sql;
        }
    } catch (Exception $e) {
        echo "Erro ao adicionar Meta: " . $e->getMessage();
    }
}

}
?>
