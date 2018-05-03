# solução de banners - avaliação fator digital

CONFIGURAÇÕES:
WampServer
PHP: 5.6
Phalcon Framework: versão 3.2.3 https://phalconphp.com/pt/
JQuery: 3.2.1
CSS: Biblioteca Material Google Design CSS
Para instalação do phalcon:
https://olddocs.phalconphp.com/en/3.0.0/reference/install.html


Desenvolvido em: 02/05/2018 à 03/05/2018

Cadastro básico para gerenciamento de um banner.
Foi criada uma ferramenta conforme o enunciado que solicitava uma solução para o cadastramento e manutenção de um banner.

Criado um pequeno crud onde é possível:
- Criar um ou mais banners com no máximo três slides
- Consultar os banners em tela de relatórios.
- Remover o banner cadastrado
- Atualizar o banner, bem como suas imagens.

Script para criação do banco está dentro do projeto com nome de banners.sql

Lógica utilizada:
Cadastro de um banner limitando a três slides.
Quando cadastrado o banner é salvo em uma tabela e em uma coluna com o json de slides que foram criados.
Em cada slide foi dada a opção de inserir um titulo e subtitulo.
Não trabalhei com cores de texto nem com hiperlinks. Apenas fiz um cadastro básico mesmo sob minha concepção.
Quando atualizado um banner, o usuário poderá alterar suas imagens e as atuais serão excluidas do servidor, ficando somente as novas.
Feitas as validações para somente extensões de imagens .png e .jpg ou .jpeg.
Feitas as validações para somente imagens com tamanho de 1280x400, exigido pela ferramenta carrossel do materialize css.


Tempo de Desenvolvimento: 
02/05/2018 das 13:00 às 17:00
02/05/2018 das 22:30 às 00:00
03/05/2018 das 10:30 às 16:00

