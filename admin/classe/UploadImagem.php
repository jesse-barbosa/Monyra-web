<?php
class UploadImagem {
    protected $novoDiretorio;

    public function getNovoDiretorio() {
        return $this->novoDiretorio;
    }

    public function upload($imagem, $local) {
        try {
            $nomeImagem = $imagem['name'];
            $nomeImagemTmp = $imagem["tmp_name"];
            $nomeImagemFinal = basename($nomeImagem);
            $imagemNova = explode('.', $nomeImagem);
    
            // Verifica se o arquivo foi realmente enviado
            if (!is_uploaded_file($nomeImagemTmp)) {
                die("Erro: Arquivo não foi enviado corretamente.");
            }
    
            // Define o diretório de destino
            $diretorioAtual = realpath(__DIR__ . "../../../img/" . $local);
    
            // Verifica se o diretório de destino existe, se não existir, cria o diretório
            if (!is_dir($diretorioAtual)) {
                if (!mkdir($diretorioAtual, 0755, true)) {
                    die("Não foi possível criar o diretório de destino.");
                }
            }
    
            // Define o caminho final do arquivo
            $caminhoImagemFinal = $diretorioAtual . "/" . $nomeImagemFinal;
    
            // Tenta mover o arquivo
            if (move_uploaded_file($nomeImagemTmp, $caminhoImagemFinal)) {
                $this->novoDiretorio = "/supermarket/img/" . $local . "/" . $nomeImagemFinal;
            } else {
                die("Erro ao mover o arquivo para o diretório de destino. Verifique permissões.");
            }
        } catch (Exception $e) {
            echo "Erro ao enviar imagem: " . $e->getMessage();
        }
    }
    
}

?>