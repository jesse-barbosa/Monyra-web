<?php
/**Classe CriaPaginacao
 * Descrição: Classe responsável por gerar a quantidade de páginas necessárias para exibir os itens do banco de dados
 * Criador: Framework de terceiros de código livre
 * Importante: Está classe para ser utilizada, deverá ser associada em uma classe de conexão Orientada a objetos
 * Data de criação: 29/07/2024
 * 
 * Pra usar esta classe é necessário criar os métodos
 *  private $strSessao, $strNumPagina, $strPaginas, $strUrl;
    Método que irá receber o número atual da página
    public function setNumPagina($x){
        $this->strNumPagina = $x;
    }
    Método que irá informar o caminho do link
    public function setUrl($x){
        $this->strUrl = $x;
    }
    Método que cria as sessões
    public function setSessao($x){
        $this->strSessao = $x;
    }
    Método que irá retornar a página atual
    public function getPagina(){
        return $this->strNumPagina;
    }
		$this->setParametro($this->strNumPagina); //Número de página atual
        $this->setFileName($this->strUrl); //Envia o nome da página atual
        $this->setInfoMaxPag(3); //Quantidade de itens por página
        $this->setMaximoLinks(2); //Quantidade de links por página 1 à 6
        $this->setSQL($sql); //Envia a sql criada
        self::iniciaPaginacao(); //Executa o método que inicia a paginação
        $contador = 0; //Contador para gerar o número de páginas
 */
include_once("Conexao.php"); //Incluir a classe de conexão

class criaPaginacao extends Conexao //Indicar o arquivo que será herdado
{
	private $ida, $param;
	private $maxPage, $maxLink, $numeroPaginas;
	private $sqlA, $sqlB;
	private $fileName, $nomeArquivoHTML;
	private $temp;
	private $passoA, $passoB;
	private $qrA, $qrB;
	private $totRegA, $totRegB;
	private $resultadoTotal, $resultadoParcial, $resultadoDiv, $numeroInt;
	private $pagAtual, $proxPag, $ultPag, $pagAnt;
	private $regInicial;
	private $dadosGerados;
	private $registroFinal;
	private $lnk_impressos;

	public function setParametro($cod)
	{
		$this->ida = $cod;
	}

	public function setFileName($file)
	{
		$this->fileName = $file;
	}

	public function setInfoMaxPag($max)
	{
		$this->maxPage = $max;
	}

	public function setMaximoLinks($max)
	{
		$this->maxLink = $max;
	}

	public function setSQL($qr)
	{
		$this->sqlA = $qr;
	}

	public function setContador($cont)
	{
		$this->registroFinal = $this->param + $cont;
	}

	public function setNomeArquivoHTML($arq)
	{
		$this->nomeArquivoHTML = $arq;
	}

	/**********************************************************************************************************/

	protected function iniciaPaginacao()
	{
		if (empty($this->ida)) {
			$this->param = 0;
		} else {
			$this->temp = $this->ida;
			$this->passoA = $this->temp - 1;
			$this->passoB = $this->passoA * $this->maxPage;
			$this->param = $this->passoB;
		}
		//$parametroTemp = $this->parametro - 1;
		$this->sqlB = $this->sqlA . " LIMIT " . $this->param . "," . $this->maxPage;

		//cria as conexões Aqui deve inserir os métodos da conexao
		$this->qrA = self::execSql($this->sqlA); // Colocar o método da conexão que executa uma SQL
		$this->qrB = self::execSql($this->sqlB); // Colocar o método da conexão que executa uma SQL
		$this->totRegA = self::contarDados($this->qrA); // Colocar o método da conexão verifica o total de dados encontratos
		$this->totRegB = self::contarDados($this->qrB); // Colocar o método da conexão verifica o total de dados encontratos

		//carrega as variáveis

		$this->resultadoTotal = $this->totRegA;
		$this->resultadoParcial = $this->totRegB;
		$this->resultadoDiv = $this->resultadoTotal / $this->maxPage;
		$this->numeroInt = (int)$this->resultadoDiv;
		if ($this->numeroInt < $this->resultadoDiv) {
			$this->numeroPaginas = $this->numeroInt + 1;
		} else {
			$this->numeroPaginas = $this->resultadoDiv;
		}
		$this->pagAtual = $this->param / $this->maxPage + 1;
		$this->regInicial = $this->param + 1;
		$this->pagAnt = $this->pagAtual - 1;
		$this->proxPag = $this->pagAtual + 1;
	}
	protected function results()
	{
		$this->dadosGerados = self::listarDados($this->qrB); //Aqui deve inserir os dados da conexao
		return $this->dadosGerados;
	}

	/**********************************************************************************************************/

	public function geraNumeros()
	{

		if ($this->ida > 1) {
			echo "<li class='mx-2'><a href=\"$this->fileName&pg=$this->pagAnt\" class='link link-underline link-underline-opacity-0 link-underline-opacity-100-hover' title=\"$this->pagAnt\">Anterior</a>\n<li>";
		}
		if ($this->temp >= $this->maxLink) {
			if ($this->numeroPaginas > $this->maxLink) {
				$n_maxlnk = $this->temp + 6;
				$this->maxLink = $n_maxlnk;
				$n_start = $this->maxLink - 6;
				$this->lnk_impressos = $n_start;
			}
		}
		//mostra os números das páginas
		while (($this->lnk_impressos < $this->numeroPaginas) and ($this->lnk_impressos < $this->maxLink)) {
			$this->lnk_impressos++;
			// Mostra a página atual sem o link
			if ($this->pagAtual == $this->lnk_impressos) {
				echo "<li class='mx-2'>$this->lnk_impressos \n</li>";
				//mostra os números das 
			} else {
				echo "<li class='mx-1'><a href=\"$this->fileName&pg=$this->lnk_impressos\" class='link link-underline link-underline-opacity-0 link-underline-opacity-100-hover' title=\"$this->lnk_impressos\">$this->lnk_impressos</a></li>\n";
			}
		}
		// mostra o link PRÓXIMO >>
		if ($this->proxPag <= $this->numeroPaginas) {
			echo "<li class='mx-2'><a href=\"$this->fileName&pg=$this->proxPag\" class='link link-underline link-underline-opacity-0 link-underline-opacity-100-hover' title=\"$this->proxPag\">Próximo</a></li>";
		}
	}
	public function getTime()
	{
		list($sec, $usec) = explode(" ", microtime());
		return ($sec + $usec);
	}
}
