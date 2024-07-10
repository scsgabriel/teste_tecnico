# teste_tecnico

# Sistema de Consulta de Contratos

Este sistema permite consultar contratos armazenados em um banco de dados MySQL.
Abaixo estão detalhadas as funcionalidades e instruções de uso:

Banco de Dados
O sistema utiliza um banco de dados MySQL chamado averbacoes, que contém as seguintes tabelas:

# tb_contrato: Armazena informações sobre contratos.

codigo: Chave primária autoincremental.
prazo: Prazo do contrato em meses.
valor: Valor do contrato.
data_inclusao: Data de inclusão do contrato.
convenio_servico: Chave estrangeira para tabela tb_convenio_servico.

# tb_convenio_servico: Relaciona convênios a serviços.

codigo: Chave primária.
convenio: Chave estrangeira para tabela tb_convenio.
servico: Serviço relacionado ao convênio.

# tb_convenio: Informações sobre convênios.

codigo: Chave primária.
convenio: Nome do convênio.
verba: Verba associada ao convênio.
banco: Chave estrangeira para tabela tb_banco.

# tb_banco: Dados dos bancos relacionados aos convênios.

codigo: Chave primária.
nome: Nome do banco.
Funcionalidades do Script PHP
Consulta de Contratos

##########################################################################################################################################

O script conection.php permite a conexão com o serivodr local usando o phpMyAdmin(MySQL) e o XAMPP, usando o servidor local Apache.
O script disponibiliza o banco de dados para o index.php e o permite buscar contratos no banco de dados.

Instruções:

Busca por Número de Contrato:
Insira o número do contrato no campo de busca e clique em "Buscar". Os resultados serão exibidos na tabela abaixo.

Listagem de Todos os Contratos:
Se o campo de busca estiver vazio, todos os contratos serão listados.

Limpar Busca:
Clique no botão "Limpar" para limpar o campo de busca e os resultados exibidos.

Números dos contratos para testes: 1, 2, 3, 4, 5.

Formato de Exibição:

Banco: Nome do banco associado ao contrato.
Verba: Verba disponível pelo convênio relacionado.
Código do Contrato: Número único de identificação do contrato.
Data de Inclusão: Data em que o contrato foi registrado no sistema (formato DD/MM/AAAA).
Valor: Valor do contrato formatado como R$X,XX.
Prazo: Prazo do contrato em meses.
