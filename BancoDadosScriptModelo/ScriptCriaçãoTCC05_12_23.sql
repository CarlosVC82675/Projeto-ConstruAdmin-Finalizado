drop schema if exists tcc_Cristiane;

create schema if not exists tcc_Cristiane;

use tcc_Cristiane;

create table if not exists obras(
idObras integer unsigned primary key auto_increment,
nome varchar(50) not null,
status enum('Andamento','Finalizado'),
descricao varchar(255) null,
tamanho varchar(255) null, 
tipo enum('Residencial','Comercial','Industrial','Infraestrutura','Saneamento','Restauro') not null,
logradouro varchar(100) not null,
numResidencial varchar(100) not null,
bairro varchar(100) not null,
cidade varchar(80) not null,
estado varchar(80) not null,
cep varchar(9) not null, 
estrutura enum('Metálica','Concreto','Madeira') not null, 
proposito varchar(255) null, 
dtFinal date null, 
dtInicial date null, 
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists estoque (
idEstoque integer unsigned primary key auto_increment,
nomeEstoque VARCHAR(100) not null,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists materiais_estoque (
idMateriais integer unsigned auto_increment primary key,
Estoque_idEstoque integer unsigned,
FOREIGN KEY (Estoque_idEstoque)
REFERENCES estoque(idEstoque)
on delete cascade
on update cascade,
    
kg decimal(5,2) not null,
nomeM varchar(50) not null,
metros decimal(38,4),
quantidade int not null,
dtVencimento date,
dtEntrada date not null,
dtSaida date,
Status_2 enum('usado', 'novo') not null,
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS lista_materiais_necessarios (
Obras_idObras integer unsigned,
FOREIGN KEY (Obras_idObras) 
REFERENCES obras(idObras) 
on update cascade
on delete cascade,
    
Materiais_idMateriais integer unsigned,
FOREIGN KEY (Materiais_idMateriais) 
REFERENCES materiais_estoque(idMateriais)
on update cascade
on delete restrict,
    
quantidade integer,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists usuarios (
idUsuario integer unsigned primary key auto_increment,
Estoque_idEstoque integer unsigned not null, 
CONSTRAINT FK_IdEstoque_Usuario
FOREIGN KEY (Estoque_idEstoque)
REFERENCES estoque (idEstoque)
on update cascade
on delete cascade,
password varchar(255) not null unique,
name varchar(50) not null, 
lastName varchar(80) not null, 
genero enum('Feminino','Masculino') not null, 
cep char(12) not null, 
cpf char(12) unique not null, 
pais varchar(50) not null, 
cidade varchar(80) not null, 
estado varchar(50) not null, 
email varchar(255) unique not null, 
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists telefone_usuarios (
telefone varchar(50) unique, 
Usuarios_idUsuario integer unsigned,
CONSTRAINT FK_Usuario_Telefone
FOREIGN KEY (Usuarios_idUsuario)
REFERENCES usuarios (idUsuario)
on update cascade
on delete cascade,
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists lista_obras (
Obras_idObras integer unsigned,
CONSTRAINT FK_Obras_idObras
FOREIGN KEY (Obras_idObras)
REFERENCES obras (idObras)
on update cascade
on delete restrict,

Usuario_idUsuario integer unsigned,
CONSTRAINT FK_Usuario_idUsuario
FOREIGN KEY (Usuario_idUsuario)
REFERENCES usuarios (idUsuario)
on update cascade
on delete cascade,

created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
); 


create table if not exists arquivo (
idArquivo integer unsigned primary key auto_increment ,
caminho varchar(255),
nome varchar(50),
tipo varchar(50),
extensao varchar(255),
Obras_IdObras integer unsigned,
CONSTRAINT FK_IdObras_Arquivo
FOREIGN KEY (Obras_IdObras)
REFERENCES obras (idObras)
on update cascade
on delete cascade,
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists roles (
id bigint unsigned primary key auto_increment, 
name enum('Administrador','Supervisor','Apontador','Engenheiro','Cliente','Comum') not null,
guard_name varchar(255), 
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
UNIQUE KEY unique_name_guard (name, guard_name)
);

create table if not exists permissions (
id bigint unsigned primary key auto_increment, 
name varchar(255) not null,
guard_name varchar(255), 
created_at timestamp DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

create table if not exists role_has_permissions (
permission_id bigint unsigned,
CONSTRAINT Fk_permission_id
FOREIGN KEY (permission_id)
REFERENCES permissions (id)
on update restrict
on delete cascade,

role_id bigint unsigned,
CONSTRAINT Fk_role_id
FOREIGN KEY (role_id)
REFERENCES roles (id)
on update restrict
on delete cascade,
PRIMARY KEY (role_id,permission_id)
);

create table if not exists  model_has_roles (
role_id bigint unsigned,
CONSTRAINT Fk_Idrole_model
FOREIGN KEY (role_id)
REFERENCES roles (id)
on update restrict
on delete cascade,

model_type varchar(255),

model_id integer unsigned,
CONSTRAINT Fk_Idmodel_role
FOREIGN KEY (model_id)
REFERENCES usuarios (idUsuario)
on delete cascade
on update cascade,

PRIMARY KEY (role_id, model_id, model_type)
);

create table if not exists  model_has_permissions (
permission_id bigint unsigned,
CONSTRAINT Fk_IdPermission_model
FOREIGN KEY (permission_id)
REFERENCES permissions (id)
on delete cascade,

model_type varchar(255),

model_id integer unsigned,
CONSTRAINT Fk_Idmodel_permissions
FOREIGN KEY (model_id)
REFERENCES usuarios (idUsuario)
on delete cascade
on update cascade,

PRIMARY KEY (permission_id, model_id, model_type)
);

create table if not exists card_atividades(
idCard integer unsigned primary key auto_increment,
titulo varchar(100),

Obras_IdObras integer unsigned,
CONSTRAINT FK_IdObras_card
FOREIGN KEY (Obras_IdObras)
REFERENCES obras (idObras)
on delete cascade
on update cascade
);

create table if not exists atividade(
idAtividade integer unsigned primary key auto_increment,
name varchar(50),
etiqueta blob,
anexo blob,
descricao varchar(250),
dtFinal date,
dtInicial date,
statusAtv enum('COMEÇANDO','ANDAMENTO','FINALIZADA'),

card_atividades_idCard integer unsigned,
CONSTRAINT Fk_IdCard_atividade
FOREIGN KEY (card_atividades_idCard )
REFERENCES card_atividades (idCard)
on delete cascade
on update cascade
);

create table if not exists comentarios(
idComentarios integer unsigned primary key auto_increment,

Atividade_idAtividade integer unsigned,
CONSTRAINT FK_idAtividade_comentarios
FOREIGN KEY (Atividade_idAtividade)
REFERENCES atividade (idAtividade)
on delete cascade
on update cascade,

Usuarios_idUsuario integer unsigned,
CONSTRAINT FK_IdUsuario_comentarios
FOREIGN KEY (Usuarios_idUsuario)
REFERENCES usuarios (idUsuario)
on update cascade
on delete set null,

comentario text
);




