# Crud Simples #

Um crud simples em PHP+PDO+Bootstrap se frameworks e sem ajax.

A ideia principal é criar um pequeno sistema com telas crud (create, read, update, delete), sem usar frameworks no lado do servidor, e sem uso de ajax. Um crud bem característico do início do php, para que possamos também compreender como os sistemas eram criados naquela época.

## Arquivos ##

Vamos descrever a seguir a funcionalidade de cada arquivo criado no sistema:

![](http://i.imgur.com/AIDMKhv.png)

- **includes** Nesta pasta ficam os arquivos da base do sistema, que devem ser inseridos pelos outros arquivos que a usam.
- **includes/banco.php** Classe para conexão com o banco de dados mySql, através do PDO. Esta classe pode ser utilizada em qualquer sistema PHP para acesso ao banco de dados através do PDO. A forma de utilização desta classe está descrita no tópico a seguir.
- **includes/cabecalho.php** Contém o cabeçalho HTML da página, incluindo a chamada ao bootstrap, a inclusão do título da página, do menu.php e de uma mensagem de erro definida através da variável ERRO.
- **includes/config.php** Contém as configurações do sistema, como as informações de acesso ao banco de dados, o menu da aplicação, além da inclusão de arquivos base ao sistema. Toda página deve incluir este arquivo.
- **includes/funcoes.php** Funções diversas do sistema
- **includes/menu.php** É o menu superior da aplicação, que usa o config.php para incluir os itens de menu. Para incluir um item no menu, edite o arquivo config.php e não este.
- **inlcudes/rodape.php** Inclui a parte html do final da pagina, incluindo os arquivos jquery e bootstrap via CDN
- **index.php** arquivo de entrada do sistema, mas q não faz muita coisa. Veja que existe o método `checkLogin()` nele que verifica se a pessoa esta logada ou não no sistema.
- **loginForm.php** O formulário de login da aplicação. Todos os formulários são auto contidos, ou seja, quando o usuário clica no botão submit, a página recarrega os dados são tratados.
- **logou.php** Realiza o logout do sistema, que consiste em limpar a sessao cuja id é `login_id`, que guarda o id do usuario logado
- **README.md** Este arquivo
- **templatePagina.php** Um template para que o programador possa copiar e colar uma pagina padrao do sistema
- **usuariosEditar.php** Realiza a edição de um usuário
- **usuariosExcluir.php** Reakuza a exclusão de um usuário. Inicialmente mostra uma mensagem perguntando se deseja excluir. Se o usuário clicar no botão "Sim", a página é recarregada pelo botao submit e o usuário é excluido.
- **usuariosListar.php** Exibe uma listagem dos usuários cadastrados na tabela
- **usuariosNovo.php** Cria um novo usuário
- **usuariosShow.php** Exibe informações de um novo usuário, além do botao Editar e Excluir

## Uma nota sobre CDN ##

Os arquivos javascript e css da aplicação são incluidos através de seus respectivos caminhos CDN. Ou seja, ao invés de copiar o arquivo jquery.js para o sistema, nós estamos adicionando-o diretamente do servidor do google, conforme podemos ver a seguir:

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

Isso significa que, para que a aplicação funcione como um todo, é necessário estar conectado à Internet.


## Banco de dados e tabelas

A seguir a sql para criar as tabelas do sistema. Inicialmente crie um banco de dados com o nome `crud` e execute as seguinte sql:
	
	CREATE TABLE IF NOT EXISTS `usuarios` (
	  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
	  `nome` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `senha` varchar(100) NOT NULL,
	  `login` varchar(100) NOT NULL,
	  PRIMARY KEY (`idusuario`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

	INSERT INTO `usuarios` (`idusuario`, `nome`, `email`, `senha`, `login`) VALUES
	(1, 'Administrador', 'admin@admin.com', 'admin', 'admin');


## Instalação

A instalação consiste em ter o banco de dados pronto, juntamente com a tabela usuarios, e alterar o arquivo `config.php` para apontar para  o seu banco de dados. No Wamp, a configuração padrão é esta:

	//
	//Configuracao do banco de dados
	//
	define("DB_HOST","localhost");
	define("DB_NAME","crud");
	define("DB_USER","root");
	define("DB_PASSWORD","");

Ou seja, usuário `root` e senha é vazio. Altere conforme a sua necessidade.