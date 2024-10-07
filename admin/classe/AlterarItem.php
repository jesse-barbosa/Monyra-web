<?php
include_once("Conexao.php");
include_once("UploadImagem.php");

class Alterar extends Conexao {
    public function __construct() {
        parent::__construct();
    }

    public function alterarCategoria($idCategoria, $nome, $descricao) {
        try {
            $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";

            $stmt = $this->getConnection()->prepare($sql);

            $stmt->bind_param("ssi", $nome, $descricao, $idCategoria);

            if ($stmt->execute()) {
            } else {
                echo "Erro ao atualizar Categoria: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
    // Função para alterar os dados de um produto
    public function alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $imagem = null){
        try {

            // Query de atualização com ou sem imagem
            if ($imagem !== null && $imagem !== '') {
                // Instanciar classe UploadImagem
                $uploadImagem = new UploadImagem();
                $uploadImagem->upload($imagem, 'products');

                $novoDiretorioImagem = $uploadImagem->getNovoDiretorio();
                if (!$novoDiretorioImagem) {
                    throw new Exception("Erro ao fazer upload da imagem.");
                }
                $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, category_id = ?, status = ?, image = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssdisssi", $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $novoDiretorioImagem, $idProduto);
            } else {
                $sql = "UPDATE products SET name = ?, description = ?, in_stock = ?, price = ?, category_id = ?, status = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssdissi", $nome, $descricao, $quantidade, $preco, $categoria, $situacao, $idProduto);
            }
    
            // Executa o SQL e retorna o resultado da operação
            if ($stmt->execute()) {
                return true;
            } else {
                return "Erro ao atualizar produto: " . $stmt->error;
            }
        } catch (Exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function alterarPedido($idPedido, $userId, $productId, $quantidade, $situacao){
        try {
            $sql = "UPDATE orders SET user_id = ?, product_id = ?, quantity = ?, status = ? WHERE id = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("iiisi", $userId, $productId, $quantidade, $situacao, $idPedido);
    
            // Executa o SQL e retorna o resultado da operação
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Erro ao atualizar pedido: " . $stmt->error;  // Mostra o erro, se houver
                return false;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();  // Mostra o erro, se houver
        }
    }
    
    public function alterarUsuario($idUsuario, $nome, $email, $senha = null, $access_level, $cpf, $phone, $situacao) {
        try {
            if ($senha) {
                $sql = "UPDATE users SET name = ?, email = ?, password = ?, access_level = ?, cpf = ?, phone = ?, status = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("sssiiisi", $nome, $email, $senha, $access_level, $cpf, $phone, $situacao, $idUsuario);
            } else {
                $sql = "UPDATE users SET name = ?, email = ?, access_level = ?, cpf = ?, phone = ?, status = ? WHERE id = ?";
                $stmt = $this->getConnection()->prepare($sql);
                $stmt->bind_param("ssiiisi", $nome, $email,  $access_level, $cpf, $phone, $situacao, $idUsuario);
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
