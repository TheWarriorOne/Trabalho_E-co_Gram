Banco de Dados

Nome: 
E-cogram

Tabelas:
categoria
produto
usuario

Colunas tabela produto:
id - int(11) - auto_increment - Primary key
descricao - varchar(120)
grupo_id - int(11) - foregn key (Tabela categoria)
grupo_nome - varchar(60) - nulo(sim) - null
usuario_id - int(11) - foregn key (Tabela usuario)
usuario_nome - varchar(60) - nulo(sim) - null
data - date
imagem - text

Colunas tabela usuario:
id - int(11) - auto_increment - Primary key
nome - varchar(120)
email - varchar(120)
senha - varchar(8)

Colunas tabela categoria:
id - int(11) - auto_increment - Primary key
nome - varchar(60)
