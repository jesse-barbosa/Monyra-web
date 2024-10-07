<?php
include_once("Conexao.php");

class Apagar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    public function apagarCategoria($idCategoria){
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idCategoria);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>alert('Categoria apagada com sucesso!');window.location.href = 'index.php?tela=cadListarCategoria'</script>";
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=cadListarCategoria'</script>";
            exit();
        }
    }
    public function apagarProduto($idProduto) {
        try {
            // Consulta preparada para deletar o produto
            $sql = "DELETE FROM products WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . $this->getConnection()->error);
            }

            // Vincular parâmetros e executar a consulta
            $stmt->bind_param('i', $idProduto);
            $result = $stmt->execute();
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . $stmt->error);
            }

            $stmt->close();
            echo "<script>alert('Produto apagado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
            exit();
        } catch (Exception $e) {
            error_log("Erro ao apagar produto: " . $e->getMessage());
            echo "<script>alert('Erro ao apagar produto: " . $e->getMessage() . "');window.location.href = 'index.php?tela=cadListarProduto'</script>";
            exit();
        }
    }
    public function apagarUsuario($idUsuario) {
        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("i", $idUsuario);

            if ($stmt->execute()) {
                echo "<script>alert('Usuário apagado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario';</script>";
            } else {
                echo "Erro ao excluir usuário: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
