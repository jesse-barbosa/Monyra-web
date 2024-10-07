<?php
include_once("Conexao.php");
class ManipularDados extends Conexao{
    protected $tabela,$campo,$campoId,$valorId,$dados,$status,$sql,$query;
    /**Método que recebe o nome da tebela para a construção de uma crud */
    private function getTabela(){
        return $this->tabela;
    }
    private function setTabela($t){
        $this->tabela = $t;
    }
    public function acessarTabela($t){
        $this->setTabela($t);
        return $this->getTabela();
    }
    /**Método que recebe o nome do campo da tabela */
    private function getCampo(){
        return $this->campo;
    }
    private function setCampo($c){
        $this->campo = $c;
    }
    public function acessarCampo($c){
        $this->setCampo($c);
        return $this->getCampo();
    }
    /**Método que recebe o campo de identificação, normalmente é o código */
    private function getCampoId(){
        return $this->campoId;
    }
    private function setCampoId($ci){
        $this->campoId = $ci;
    }
    public function acessarCampoId($ci){
        $this->setCampoId($ci);
        return $this->getcampoId();
    }
    /**Método que informa o valor de identificação, geralmente é o número do código atribuido ao cadastro */
    private function getValorId(){
        return $this->valorId;
    }
    private function setValorId($vi){
        $this->valorId = $vi;
    }
    public function acessarValorId($vi){
        $this->setValorId($vi);
        return $this->getValorId();
    }
    /**Método para recebe os dados que serão gravados no banco */
    private function getDados(){
        return $this->dados;
    }
    private function setDados($d){
        $this->dados = $d;
    }
    public function acessarDados($d){
        $this->setDados($d);
        return $this->getDados();
    }
    /**Método que retorna o status de cada função */
    public function getStatus(){
        return $this->status;
    }
    /**Método que grava dados no banco de dados 
     * Exemplo de uso:
     * $this->acessarTabela("nome_da_tabela");
     * $this->acessarCampo("nome_do_campo");
     * $this->acessarDados("'valor'");
     * self::inserirDados();
    */
    protected function inserirDados(){
        if(self::getVerificarDuplicidade($this->valorId) != 0){
            echo "O cadastro já existe na base de dados.";
        }else{
            try {
                $this->sql = "INSERT INTO $this->tabela ($this->campo) VALUES ($this->dados)";
                if (self::execSql($this->sql)) {
                    $this->status = "Cadastrado com sucesso.";
                }
            } catch (Exception $e) {
                echo "<b><center>Função InserirDados</center></b>";
                echo "<p><b>Erro de SQL: </b> ".$this->sql."</p>";
                echo "<p><b>Erro ao inserir o dado. </b>" . $e->getMessage()."</p>";
            }
        }
    }
    /**Método que apaga dados no banco de dados 
     * Exemplo de uso:
     * $this->acessarTabela("tbnewsletter"); - nome da tabela que será pesquisada
     * $this->acessarCampo("emailNewsLetter"); - o campo que está na tabela no banco de dados
     * $this->acessarDados("sara@gmail.com"); - o valor que deseja apagar
     * $this->acessarValorId("'sara@gmail.com'"); - o valor que irá ser pesquisado antes de ser apagado
     * self::apagarDados();
    */
    public function apagarDados(){
        if(self::getVerificarDuplicidade($this->valorId) > 0){
            try {
            $this->sql = "DELETE FROM $this->tabela WHERE $this->campo = '$this->dados'";
                if (self::execSql($this->sql)) {
                    $this->status = "Apagado com sucesso.";
                }
            } catch (Exception $e) {
                echo "<b><center>Função getTotalDadosAtualizar</center></b>";
                echo "<p><b>Erro de SQL: </b> " . $this->sql."</p>";
                echo "<p><b>Erro ao apagar o dado. </b>" . $e->getMessage()."</p>";
            }
        }else{
            echo "O dado buscado não existe.";
        }  
    }
    /**Método que atualiza os dados no banco de dados 
     * Exemplo de uso:
     * $this->acessarTabela("tbnewsletter"); - nome da tabela que será pesquisada
     * $this->acessarCampo("emailNewsLetter='diupake@gmail.com'"); - o campo e o valor a ser atribuído
     * $this->acessarCampoId("idNewsLetter"); - normalmente é o campo código
     * $this->acessarValorId("10"); - se refere ao código
     * self::atualizarDados();
    */
    public function atualizarDados(){
        try {
            $this->sql = "UPDATE $this->tabela SET $this->campo WHERE $this->campoId = '$this->valorId'";
            if(self::execSql($this->sql)){
                $this->status = "Dados atualizados com sucesso.";
            }
        } catch (Exception $e) {
            echo "<b><center>Função getTotalDadosAtualizar</center></b>";
            echo "<p><b>Erro de SQL: </b> " . $this->sql."</p>";
            echo "<p><b>Erro ao atualizar. </b>" . $e->getMessage()."</p>";
        }
    }
    /**Método que retorna se existe duplicidade/existência do dado no banco de dados */
    protected function getVerificarDuplicidade($vp){
        try {
            $this->sql = "SELECT $this->campoId FROM $this->tabela WHERE $this->campoId = '$this->valorId'";
            $this->query = self::execSql($this->sql);
            return self::contarDados($this->query);
        } catch (Exception $e) {
            echo "<b><center>Função getVerificarDuplicidade</center></b>";
            echo "<p><b>Erro de SQL: </b> " . $this->sql."</p>";
            echo "<p><b>Erro ao verificar a duplicidade de dados. </b>" . $e->getMessage()."</p>";
        }
    }
    /**Método que retorna a quantidade de dados cadastrados 
     * Exemplo de uso
     * $this->acessarTabela("tbnewsletter");
     * $this->acessarCampoId("idNewsLetter");
     * self::getTotalDados();
    */
    public function getTotalDados(){
        try {
            $this->sql = "SELECT $this->campoId FROM $this->tabela ORDER BY $this->campoId";
            $this->query = self::execSql($this->sql);
            return self::contarDados($this->query);
        } catch (Exception $e) {
            echo "<b><center>Função getTotalDados</center></b>";
            echo "<p><b>Erro de SQL: </b> " . $this->sql."</p>";
            echo "<p><b>Erro ao retornar a quantidade total de dados. </b>" . $e->getMessage()."</p>";
        }
    }
    /**Método que verifica o último código da tabela 
     * Exemplo de uso
     * $this->acessarTabela("tbnewsletter");
     * $this->acessarCampoId("idNewsLetter");
     * self::getUltimoId();
    */
    public function getUltimoId(){
        try {
            $this->sql = "SELECT $this->campoId FROM $this->tabela ORDER BY $this->campoId DESC";
            $this->query = self::execSql($this->sql);
            $this->dados = self::listarDados($this->query);
            return $this->dados["$this->campoId"];
        } catch (Exception $e) {
            echo "<b><center>Função getUltimoId</center></b>";
            echo "<p><b>Erro de SQL: </b> " . $this->sql."</p>";
            echo "<p><b>Erro ao retornar o último código. </b>" . $e->getMessage()."</p>";
        }
    }
}