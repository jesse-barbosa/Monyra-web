# Requisitos

- Servidor Local Apache e MySQL (Sugestão: XAMPP)

# Instalação e Execução

## 1. Instale o XAMPP

Se ainda não tem o XAMPP instalado, baixe e instale a versão mais recente no [site oficial](https://www.apachefriends.org/pt_br/download.html).

## 2. Clonando o projeto

No terminal, vá até a pasta htdocs localizada em:
Windows:

    C:\xampp\htdocs

Dentro de htdocs, faça um clone do projeto:

    git clone https://github.com/jesse-barbosa/monyra-web.git

## 3. Importando o banco

- 3.1 Primeiro, ligue os servidor Apache e MySQL no XAMPP
- 3.3 Acesse o painel PhpMyAdmin: Digite "localhost/" no endereço de pesquisa do seu navegador
- 3.4 - Crie um novo banco de dados com o nome "monyra"
- 3.5 - Clique na opção de importar
- 3.6 - Importe o arquivo SQL localizado na pasta "banco" do projeto

## 4. Rode o projeto

# Com os servidores Apache e MySql do XAMPP ligados, acesse o projeto no seu navegador:

    localhost/monyra-web/
