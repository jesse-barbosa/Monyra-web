<?php
include_once("Conexao.php");

class Apagar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    // Apagar usuário
    public function apagarUsuario($codUser) {
        try {
            $sql = "DELETE FROM tbusers WHERE codUser = ?";
            $stmt = $this->getConnection()->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . $this->getConnection()->error);
            }
            $stmt->bind_param("i", $codUser);

            if ($stmt->execute()) {
                echo "<script>alert('Usuário apagado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario';</script>";
            } else {
                throw new Exception("Erro ao executar a consulta: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // Apagar transferência
    public function apagarTransferencia($idTransferencia) {
        try {
            $sql = "DELETE FROM tbtransactions WHERE codTransaction = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("i", $idTransferencia);

            if ($stmt->execute()) {
                echo "<script>alert('Transferência excluída com sucesso!');window.location.href = 'index.php?tela=cadListarTransferencias'</script>";
            } else {
                echo "Erro ao excluir transferência: " . $stmt->error;
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    // Apagar meta
    public function apagarMeta($codGoal) {
        try {
            $sql = "DELETE FROM tbgoals WHERE codGoal = ?";
            $stmt = $this->getConnection()->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . $this->getConnection()->error);
            }
            $stmt->bind_param("i", $codGoal);

            if ($stmt->execute()) {
                echo "<script>alert('Meta apagada com sucesso!');window.location.href = 'index.php?tela=cadListarMetas';</script>";
            } else {
                throw new Exception("Erro ao executar a consulta: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
