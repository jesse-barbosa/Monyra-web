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
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-codUser='".$resultado['codUser']."' data-nameUser='".$resultado['nameUser']."' data-emailUser='".$resultado['emailUser']."' data-descUser='".$resultado['descUser']."' data-incomeUser='".$resultado['incomeUser']."' data-balanceUser='".$resultado['balanceUser']."' data-iconUser='".$resultado['iconUser']."' data-typeuser='".$resultado['type_user']."'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-dark' data-id='".$resultado['codUser']."'></a></td>";
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
    public function totalTransactions() {
        try {
            $sql = "SELECT COUNT(*) as total FROM tbtransactions";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os metas: " . $e->getMessage();
        }
    }
    public function mostrarTransferencias() {
        try {
            $sql = "SELECT * FROM tbtransactions";
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
                            <th class='text-secondary fw-light'>Valor</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th class='text-secondary fw-light'>Tipo</th>
                            <th class='text-secondary fw-light'>Categoria</th>
                            <th class='text-secondary fw-light'>Usuário</th>
                            <th class='text-secondary fw-light'>Data</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach($categorias as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light'>".$resultado['codTransaction']."</td>";
                        echo "<td class='fw-light'>".$resultado['valueTransaction']."</td>";
                        echo "<td class='fw-light'>".$resultado['descTransaction']."</td>";   
                        echo "<td class='fw-light'>".$resultado['typeTransaction']."</td>";   
                        echo "<td class='fw-light'>".$resultado['categoryTransaction']."</td>";   
                        echo "<td class='fw-light'>".$resultado['userCod']."</td>";   
                        echo "<td class='fw-light'>".$resultado['created_at']."</td>";   
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editCategoryModal' data-id='".$resultado['codTransaction']."' data-value='".$resultado['valueTransaction']."' data-desc='".$resultado['descTransaction']."' data-type='".$resultado['typeTransaction']."' data-category='".$resultado['categoryTransaction']."'></a></td>";
                        echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['codTransaction']."'></i></td>";
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
    public function totalMetas() {
        try {
            $sql = "SELECT COUNT(*) as total FROM tbgoals";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);
            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os metas: " . $e->getMessage();
        }
    }

    public function mostrarMetas() {
        try {
            $sql = "SELECT * FROM tbgoals";
        
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
                            <th class='text-secondary fw-light'>Nome</th>
                            <th class='text-secondary fw-light'>Categoria</th>
                            <th class='text-secondary fw-light'>Descrição</th>
                            <th class='text-secondary fw-light'>Salvo</th>
                            <th class='text-secondary fw-light'>Total</th>
                            <th class='text-secondary fw-light'>Usuário</th>
                            <th class='text-secondary fw-light'>Data</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-light text-dark'>" . $resultado['codGoal'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['nameGoal'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['categoryGoal'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['descGoal'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['amountSaved'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['amountRemaining'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['userCod'] . "</td>";
                        echo "<td class='fw-light text-dark'>" . $resultado['created_at'] . "</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editCategoryModal' data-id='".$resultado['codGoal']."' data-name='".$resultado['nameGoal']."' data-category='".$resultado['categoryGoal']."' data-desc='".$resultado['descGoal']."' data-amountSaved='".$resultado['amountSaved']."' data-total='".$resultado['amountRemaining']."' data-created='".$resultado['created_at']."' data-userCod='".$resultado['userCod']."'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash text-black fs-5' data-id='" . $resultado['codGoal'] . "'></a></td>";
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
            echo "Erro ao mostrar os metas: " . $e->getMessage();
        }
    }
}
?>
