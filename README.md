# junior_php_task
Task de Desenvolvimento WEB Simples implementada utilizando recursos de linguagens como HTML, PHP e JavaScript, assim como a utilização de um CRUD básico via Banco de Dados Relacional MySQL, o projeto conta com:

Página de Login (login.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Confirmação de credenciais de login via Banco de Dados MySQL - (READ);</br>
> - Criação de sessão através do token de ID do funcionário, permitindo o acesso ao sistema.</br>

Página Inicial (index.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Recuperação dos dados de agendamentos para cada paciente via MySQL Query - (READ);</br>
> - Exibição dos dados recuperados em tabela com opções de gerenciamento;</br>
> - Possibilidade de personalização da exibição dos dados, ordenando-os de forma crescente ou decrescente baseado na data/hora;</br>
> - Função de esconder atendimentos já realizados para uma melhor visualização dos eventos futuros;</br>
> - Opções de manipulação dos dados, sendo possível criar registros para novos pacientes ou marcar novos agendamentos - (CREATE);</br>
> - Acesso à pagina pessoal de cada paciente registrado via seus atendimentos marcados;</br>
> - Possibilidade de Desconectar-se do sistema e encerrar a sessão.</br>

Perfil dos Pacientes (paciente.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Recuperação dinâmica dos dados do paciente via MySQL Query e parâmetros passados por GET - (READ);</br>
> - Exibição dos dados recuperados com opções de manipulação dos dados;</br>
> - Possibilidade de atualizar o registro de um paciente - (UPDATE);</br>
> - Possibilidade de exclusão do registro de um paciente - (DELETE);</br>
> - Confirmação de exclusão via box do método confirm() - Javascript.</br>

Página de Agendamento (paciente/agendar.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Exibição de todos os pacientes registrados via MySQL + ComboBox, onde o valor repassado via POST é a PK (tel), porém exibindo o nome do paciente - (READ);</br>
> - Possibilidade de definição personalizada de Dia, Mês, Ano, Hora e Minuto em que será marcada a consulta;</br>
> - Inserção do agendamento no banco de dados e consequentemente atualização automática no index dinâmico - (CREATE).</br>

Página de Atualização de Registro (paciente/update.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Exibição dos dados já existentes do paciente para tornar as alterações mais simples;</br>
> - Redirecionamento automático para a nova página do paciente após o commit das atualizações.</br>

Página de Criação de Registro (paciente/create.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Recuperação dos dados do novo paciente via POST e inserção no Banco de Dados via MySQL Query, permitindo a criação de agendamentos para o mesmo - (CREATE).</br>

Página de Remoção de Registro (paciente/create.php)
> - Confirmação da existência de sessão já iniciada e redirecionamento automático à página de login, caso necessário;</br>
> - Realização simples da exclusão (Confirmação já realizada via box do método confirm() na tela anterior) - (DELETE);</br>
> - Redirecionamento automático ao index após operação bem sucedida.</br>

Connection Factory (res/libs/db_connect.php)
> - Realização da conexão com o Banco de Dados MySQL do Projeto;</br>
> - Implementado separadamente para maior facilidade ao utilizar o método include() em outras páginas, evitando repetição do código.</br>

Funções Gerais (res/libs/functions.php)
> - Utilização do Connection Factory em suas funções;</br>
> - Conjunto de códigos utilizados em uma ou mais diferentes páginas;</br>
> - Implementado separadamente para maior facilidade ao utilizar o método include() em outras páginas, evitando repetição do código.</br>

Finalização de Sessão (res/libs/kill_session.php)
> - Simples recuperação dos dados da sessão e limpeza dos mesmos, finalizando a sessão existente.</br>

# FUNCIONAMENTO GERAL
O funcionário deve inicialmente conectar-se ao sistema, atualmente apenas um único usuário permitido está incluso nos registros.</br>
Em seguida, ele é disposto de uma dashboard onde pode visualizar todos os agendamentos realizados, sendo exibidos:
> - O nome dos pacientes (redirecionamento direto à sua página de perfil do paciente);</br>
> - A data e hora da consulta marcada, formatada no padrão brasileiro.</br></br>

A personalização para uma melhor exibição é possível através da reordenação dos agendamentos exibidos, com as opções:
> - Ordem Crescente - Exibindo todos os agendamentos;</br>
> - Ordem Decrescente - Exibindo todos os agendamentos;</br>
> - Ordem Crescente - Exibindo apenas agendamentos não expirados;</br>
> - Ordem Decrescente - Exibindo apenas agendamentos não expirados.</br></br>

Aqui, o funcionário pode:
> - Registrar um novo paciente;</br>
> - Agendar um novo atendimento;</br>
> - Visualizar o perfil de qualquer paciente já agendado;</br>
> - Desconectar do sistema.</br></br>

Ao registrar um novo paciente, o funcionário é recebido por uma nova página onde pode inserir os dados do mesmo, sendo estes salvos no sistema. Após a inserção, a página do usuário pode ser visualizada e agendamentos podem ser realizados para o mesmo.</br>

Ao agendar um novo atendimento, o funcionário é recebido por uma nova página onde pode selecionar o paciente a ser atendido, e definir o horário do atendimento, sendo estes salvos no sistema. Após a inserção, o registro do atendimento poderá ser visualizado na página inicial.</br>

Ao visualizar o perfil de algum paciente, todos os dados do mesmo serão exibidos.

Aqui o funcionário pode:
> - Atualizar os dados do paciente;</br>
> - Remover o registro do paciente;</br>

Ao atualizar os dados do paciente, o funcionário é recebido por uma nova página onde são apresentados os dados atuais do paciente em caixas editáveis, ao confirmar, os dados atualizados serão salvos no sistema. Após a atualização, o funcionário será redirecionado à pagina de perfil do paciente com os dados já atualizados.

Ao remover o registro do paciente, o mesmo é completamente excluido do sistema, juntamente com todos os agendamentos relacionados à este. Após a atualização, o funcionário será redirecionado à página inicial, com o registro e agendamentos do paciente já excluído.

# RECURSOS DO BANCO DE DADOS
A implementação do banco de dados do sistema conta com:
> - Funcionalidades simples de armazenamento de dados dos pacientes (nome, telefone, email);</br>
> - Utilização do telefone como chave primária por ser um dado único, economizando recursos que seriam gastos na criação de uma coluna "ID";</br>
> - Recursos de ON UPDATE CASCADE e ON DELETE CASCADE nos agendamentos, atualizando-os automaticamente ao atualizar os dados de um paciente.</br>

# CONSIDERAÇÕES GERAIS
Como o intúito da implementação era a verificação de conhecimentos relacionados ao back-end, não foram utilizados templates para que a criação do código fosse mais fácilmente analisável, utilizando apenas um CSS básico para uma visualização mais organizada.

Devido aos recursos de Javascript serem apresentados como pontos extras, o foco principal foi posto em torno das implementações em PHP e sua conexão com o banco MySQL, sendo implementados apenas alguns scripts onclick, com redirecionamento especificamente para url ou funções, assim como uma box de confirmação ao excluir os pacientes para preencher este quesito.

Inicialmente seria utilizado o Bootstrap, mas este foi reconsiderado devido à finalidade da implementação e portanto nenhum framework foi utilizado.
