<?php
include_once("Conexao.php");
include_once("UploadImagem.php");

class Adicionar extends Conexao {

    public function __construct(){
        parent::__construct();
    }

    public function adicionarCategoria($nome, $descricao) {
        try {
            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO categories (name, description)
                    VALUES ('$nome', '$descricao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Categoria adicionada com sucesso!');window.location.href = 'index.php?tela=cadListarCategoria'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar categoria: " . $e->getMessage();
        }
    }
    public function adicionarProduto($nome, $descricao, $quantidade, $preco, $categoria, $imagem, $situacao) {
        try {
            // Instanciar classe UploadImagem
            $uploadImagem = new UploadImagem();
            $uploadImagem->upload($imagem, 'products');

            // Verificar se o diretório da imagem foi setado corretamente
            $novoDiretorioImagem = $uploadImagem->getNovoDiretorio();
            if (!$novoDiretorioImagem) {
                throw new Exception("Erro ao fazer upload da imagem.");
            }

            // Inserir novo produto com o caminho da imagem no banco de dados
            $sql = "INSERT INTO products (name, description, price, in_stock, image, category_id, status)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("ssdisis", $nome, $descricao, $preco, $quantidade,  $novoDiretorioImagem, $categoria, $situacao);

            if ($stmt->execute()) {
                echo "<script>alert('Produto adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
                exit();
            } else {
                echo "Erro ao adicionar produto: " . $stmt->error;
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro ao adicionar produto: " . $e->getMessage();
        }
    }
    public function adicionarUsuario($nome, $email, $senha, $access_level, $cpf, $phone, $situacao){
        try {

            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO users (name, email, password, access_level, cpf, phone, status)
             VALUES ('$nome', '$email', '$senha', '$access_level', '$cpf', '$phone', '$situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Usuário adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar Usuário: " . $e->getMessage();
        }
    }
}
