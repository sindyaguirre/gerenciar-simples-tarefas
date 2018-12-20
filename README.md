# gerenciadorTarefas
Sistema Gerenciador simples de tarefas
O sistema é web. Foi utilizado as tecnologias PHP, JavaScript, Jquery, CSS e para o banco de dados MySql, para o layout foi usado o Framework Bootstrap (a melhorar).
 Suas validações são através da tecnologia HTML. 
O sistema conta com três menus fixos no topo da tela:
 
Primeiros passos 

•	O projeto dever ser salvo em um servidor local, e acessado pelo nome http://[localhost]/gerenciadorTarefas/
•	Executar a query que se encontra dentro do projeto (bdtarefas.php). Querys foram criadas para funcionar em um banco MySql.
Explicando funcionalidades
•	O sistema se inicia pela tela de tarefas, contendo um formulário de cadastro, e logo abaixo uma tabela com a lista de todos os registros de tarefas.
Página de Tarefas 
 
•	O botão de *reiniciar* página, e o botão *fechar* apenas o formulário, deixando visível apenas à tabela com todas as tarefas listadas.
•	No formulário os campos Projeto e Colaborador listam dados disponíveis no banco de dados (mostrando apenas o nomes), afim de vínculos (Tarefa X Pessoa/Tarefa X Projeto).
•	Para obter um controle de nível da tarefa deve ser utilizado o campo de nível, veja abaixo:
 
•	Para controlar a situação da tarefa deve ser utilizado o campo de Status, veja abaixo: 
•	A tabela pode ser ordenada por qualquer coluna, utilizando o ícone  
•	Para editar um registro clicar no ícone  .
•	Para exclusão de um registro de ser clicado no ícone  


Página de Projetos 

•	Esta página simples, conta com o formulário de cadastro e logo abaixo a tabela que lista todos os registros de projetos cadastrados. Serve apenas para vincular nome à tarefa.
•	A consulta não contém filtro, e a ordenação é pela coluna Código do projeto.
•	Para editar um registro clicar no ícone  .
•	Para exclusão de um registro de ser clicado no ícone  
Página de Pessoas



•	Página de pessoas, conta com o formulário de cadastro simples e logo abaixo a tabela que lista todos os registros de projetos cadastrados. Serve apenas para vincular nome à tarefa.
•	A consulta não contém filtro, e a ordenação esta fixa pela coluna Código da tabela.
•	Para editar um registro clicar no ícone  .
À ser melhorado no sistema
•	Este projeto não conta com um login, e nem controle de session
•	Não há mensagens de confirmação;
•	Não há mensagens de retorno;
•	Algumas funcionalidades podem ser acrescentadas, para uma melhor experiência com o usuário. 
•	A página de tarefas deve ser acrescentada mais algumas funcionalidades
•	Deve ser disponibilizado um filtro para cada tabela de consulta
•	Deve ser montada uma lógica de agrupamento de registros.
•	O projeto não esta corretamente em MVC;
•	O Framework Bootstrap deve ser reestruturado para se obter a funcionalidade utilizada em qualquer dispositivo.
