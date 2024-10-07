<?php
include_once("CriaPaginacao.php");

class Mostrar extends CriaPaginacao {
    private $strNumPagina, $strUrl, $strSessao;

    public function setNumPagina($x) {
        $this->strNumPagina = $x;
    }

    public function setUrl($x) {
        $this->strUrl = $x;
    }

    public function setSessao($x) {
        $this->strSessao = $x;
    }

    public function getPagina() {
        return $this->strNumPagina;
    }
    public function totalUsuarios() {
        try {
            $sql = "SELECT COUNT(*) as total FROM tbusers";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os usuarios: " . $e->getMessage();
        }
    }
        public function mostrarUsuario() {
        try {
            $sql = "SELECT * FROM tbusers";
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;

            $usuarios = $this->results();

            if (count($usuarios) > 0) {
                echo "
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Nome</th>
                            <th class='text-secondary fw-light'>Email</th>
                            <th class='text-secondary fw-light'>Senha</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th class='text-secondary fw-light'>Renda</th>
                            <th class='text-secondary fw-light'>Saldo</th>
                            <th class='text-secondary fw-light'>Ícone</th>
                            <th class='text-secondary fw-light'>Acesso</th>

                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($usuarios as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light'>".$resultado['codUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['nameUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['emailUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['passwordUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['descUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['incomeUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['balanceUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['iconUser']."</td>";
                        echo "<td class='fw-light'>".$resultado['type_user']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-id='".$resultado['id']."' data-nome='".$resultado['name']."' data-email='".$resultado['email']."' data-cpf='".$resultado['cpf']."' data-phone='".$resultado['phone']."' data-accesslevel='".$resultado['access_level']."' data-situacao='".$resultado['status']."'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-dark' data-id='".$resultado['id']."'></a></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "Nenhum dado encontrado.";
            }
        } catch (Exception $e) {
            echo "Erro: ".$e->getMessage();
        }
    }
    public function mostrarCategoria() {
        try {
            $sql = "SELECT * FROM categories";
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;
            $categorias = $this->results();

            if (count($categorias) > 0) {
                echo "
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Nome</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($categorias as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light'>".$resultado['id']."</td>";
                        echo "<td class='fw-light'>".$resultado['name']."</td>";
                        echo "<td class='fw-light'>".$resultado['description']."</td>";   
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editCategoryModal' data-id='".$resultado['id']."' data-nome='".$resultado['name']."' data-descricao='".$resultado['description']."'></a></td>";
                        echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['id']."'></i></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "Nenhum dado encontrado.";
            }
        } catch (Exception $e) {
            echo "Erro: ".$e->getMessage();
        }
    }
    public function totalProdutos() {
        try {
            $sql = "SELECT COUNT(*) as total FROM products";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os produtos: " . $e->getMessage();
        }
    }

    public function mostrarProdutos() {
        try {
            $sql = "
            SELECT 
                p.id as idProduct, 
                p.name as nameProduct, 
                p.description as descProduct, 
                p.price as priceProduct, 
                p.in_stock as quantProduct, 
                p.image as urlImage, 
                c.name as nameCategory,
                c.id as idCategory,
                p.status as statusProduct
            FROM 
                products p
            LEFT JOIN 
                categories c ON p.category_id = c.id";
        
            // Configurações de paginação
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            $this->iniciaPaginacao();
        
            $produtos = $this->results();
        
            if (count($produtos) > 0) {
                echo "
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Produto</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th class='text-secondary fw-light'>Valor</th>
                            <th class='text-secondary fw-light'>Quantidade</th>
                            <th class='text-secondary fw-light'>Imagem</th>
                            <th class='text-secondary fw-light'>Categoria</th>
                            <th class='text-secondary fw-light'>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light text-dark'>" . $resultado['idProduct'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['nameProduct'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['descProduct'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['priceProduct'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['quantProduct'] . "</td>";
                        if (!empty($resultado['urlImage'])) {
                            echo "<td class='fw-light text-dark'><img src='" . $resultado['urlImage'] . "' width='80px' alt='Imagem do Produto'/></td>";
                        } else {
                            echo "<td class='fw-light text-dark'>Sem imagem</td>";
                        }
                        echo "<td class='fw-light text-dark'>" . $resultado['nameCategory'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['statusProduct'] . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil text-black fs-5' 
                        data-bs-toggle='modal' 
                        data-bs-target='#editProductModal' 
                        data-id='" . $resultado['idProduct'] . "' 
                        data-url='" . $resultado['urlImage'] . "' 
                        data-nome='" . $resultado['nameProduct'] . "' 
                        data-descricao='" . $resultado['descProduct'] . "' 
                        data-quantidade='" . $resultado['quantProduct'] . "' 
                        data-preco='" . $resultado['priceProduct'] . "'
                        data-categoria='" . $resultado['idCategory'] . "'
                        data-situacao='" . $resultado['statusProduct'] . "'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash text-black fs-5' data-id='" . $resultado['idProduct'] . "'></a></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "<p class='text-center text-dark pt-2'>Nenhum produto cadastrado.</p>";
            }
        } catch (Exception $e) {
            echo "Erro ao mostrar os produtos: " . $e->getMessage();
        }
    }
    public function totalPedidos() {
        try {
            $sql = "SELECT COUNT(*) as total FROM orders";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os pedidos: " . $e->getMessage();
        }
    }

    public function mostrarPedidos() {
        try {
            $sql = "
            SELECT
                o.id,
                o.user_id,
                o.product_id,
                o.quantity,
                o.status,
                u.name as nameUser,
                u.id as idUser,
                p.id as idProduct,
                p.name as nameProduct,
                p.price as priceProduct,
                p.image as urlImage
            FROM 
                orders o
            LEFT JOIN users u ON o.user_id = u.id
            LEFT JOIN products p ON o.product_id = p.id";
        
            // Configurações de paginação
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(5);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            $this->iniciaPaginacao();
        
            $produtos = $this->results();
        
            if (count($produtos) > 0) {
                echo "
                <table class='table table-hover'>
                    <thead>
                        <tr class='text-center'>
                            <th class='text-secondary fw-light'>ID</th>
                            <th class='text-secondary fw-light'>Usuário</th>
                            <th class='text-secondary fw-light'>Produto</th>
                            <th class='text-secondary fw-light'>Imagem</th>
                            <th class='text-secondary fw-light'>Quantidade</th>
                            <th class='text-secondary fw-light'>Situação</th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light text-dark'>" . $resultado['id'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['nameUser'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['nameProduct'] . "</td>";
                        if (!empty($resultado['urlImage'])) {
                            echo "<td class='fw-light text-dark'><img src='" . $resultado['urlImage'] . "' width='80px' alt='Imagem do Produto'/></td>";
                        } else {
                            echo "<td class='fw-light text-dark'>Sem imagem</td>";
                        }
                        echo "<td class='fw-light text-dark'>" . $resultado['quantity'] . "</td>";
                        $status = '';
                        switch($resultado['status']){
                            case 0:
                                $status = "Pendente";
                                break;
                            case 1:
                                $status = "Confirmado";
                                break;
                            case 2:
                                $status = "Cancelado";
                                break;
                            default:
                                $status = "Sem status";
                                break;
                        }
                        echo "<td class='fw-light text-dark'>" . $status . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil text-black fs-5' 
                        data-bs-toggle='modal' 
                        data-bs-target='#editProductModal' 
                        data-id='" . $resultado['id'] . "'
                        data-userid='" . $resultado['user_id'] . "'
                        data-productid='" . $resultado['product_id'] . "'
                        data-quantity='" . $resultado['quantity'] . "'
                        data-status='" . $resultado['status'] . "'";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "<p class='text-center text-dark pt-2'>Nenhum pedido solicitado.</p>";
            }
        } catch (Exception $e) {
            echo "Erro ao mostrar os pedidos: " . $e->getMessage();
        }
    }

}
?>
