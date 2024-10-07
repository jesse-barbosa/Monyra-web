<?php
abstract class Conexao {
    protected $servidor, $usuario, $senha, $banco, $conectar, $sql, $query, $dados, $totalDados;

    /** Método construtor para realizar uma conexão no banco de dados */
    public function __construct(){
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->senha = "";
        $this->banco = "dbmonyra";
        self::conectar();
    }

    /** Método que realiza a conexão com o banco */
    protected function conectar()
    {
        try {
            $this->conectar = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->banco);
            
            // Verifica se a conexão foi bem-sucedida
            if (!$this->conectar) {
                throw new Exception("Falha na conexão: " . mysqli_connect_error());
            }
        } catch (Exception $e) {
            echo "Erro ao conectar o banco de dados: " . $e->getMessage();
        }
    }

    /** Método que executa uma consulta SQL */
    protected function execSql($sql)
    {
        // Verifica se a conexão está ativa
        if (!$this->conectar) {
            throw new Exception("Conexão com o banco de dados não estabelecida.");
        }

        $this->sql = mysqli_query($this->conectar, $sql);

        // Verifica se a consulta foi bem-sucedida
        if (!$this->sql) {
            throw new Exception("Erro na execução da consulta: " . mysqli_error($this->conectar));
        }

        return $this->sql;
    }

    /** Método para listar os dados de uma consulta */
    protected function listarDados($qr)
    {
        if (!$qr) {
            throw new Exception("Resultado da consulta é inválido.");
        }
            $dados = [];
            while ($linha = mysqli_fetch_assoc($qr)) {
            $dados[] = $linha;
        }
        return $dados;

    }

    /** Método que conta o número de registros retornados */
    protected function contarDados($qr)
    {
        if (!$qr) {
            throw new Exception("Resultado da consulta é inválido.");
        }
        $this->totalDados = mysqli_num_rows($qr);
        return $this->totalDados;
    }
}
