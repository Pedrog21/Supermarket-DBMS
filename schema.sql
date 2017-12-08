drop table if exists categoria CASCADE;
drop table if exists categoria_simples CASCADE;
drop table if exists super_categoria CASCADE;
drop table if exists constituida CASCADE;
drop table if exists produto CASCADE;
drop table if exists fornecedor CASCADE;
drop table if exists fornece_sec CASCADE;
drop table if exists corredor CASCADE;
drop table if exists prateleira CASCADE;
drop table if exists planograma CASCADE;
drop table if exists evento_reposicao CASCADE;
drop table if exists reposicao CASCADE;

create table categoria (
  nome varchar(255) primary key
);

create table categoria_simples (
  nome varchar(255) primary key,
  foreign key (nome) references categoria(nome) ON DELETE CASCADE
);

create table super_categoria (
  nome varchar(255) primary key,
  foreign key (nome) references categoria(nome) ON DELETE CASCADE
);

create table constituida (
  super_categoria varchar(255),
  categoria varchar(255),
  primary key (super_categoria, categoria),
  foreign key (super_categoria) references super_categoria(nome) ON DELETE CASCADE,
  foreign key (categoria) references categoria(nome) ON DELETE CASCADE
);

create table fornecedor (
  nif varchar(255) primary key,
  nome varchar(255)
);

create table produto (
  ean varchar(255) primary key,
  design varchar(255),
  categoria varchar(255),
  forn_primario varchar(255),
  data DATE,
  foreign key (categoria) references categoria(nome) ON DELETE CASCADE,
  foreign key (forn_primario) references fornecedor(nif) ON DELETE CASCADE
);

create table fornece_sec (
  nif varchar(255),
  ean varchar(255),
  primary key (nif, ean),
  foreign key (nif) references fornecedor(nif) ON DELETE CASCADE,
  foreign key (ean) references produto(ean) ON DELETE CASCADE
);

create table corredor (
  nro int primary key,
  largura varchar(255)
);

create table prateleira (
  nro int,
  lado varchar(255),
  altura varchar(255),
  primary key (nro, lado, altura),
  foreign key (nro) references corredor(nro) ON DELETE CASCADE
);

create table planograma (
  ean varchar(255),
  nro int,
  lado varchar(255),
  altura varchar(255),
  face varchar(255),
  unidades int,
  loc varchar(255),
  primary key (ean, nro, lado, altura),
  foreign key (ean) references produto(ean) ON DELETE CASCADE,
  foreign key (nro, lado, altura) references prateleira(nro, lado, altura) ON DELETE CASCADE
);

create table evento_reposicao (
  operador varchar(255),
  instante timestamp,
  primary key (operador, instante)
);

create table reposicao (
  ean varchar(255),
  nro int,
  lado varchar(255),
  altura varchar(255),
  operador varchar(255),
  instante timestamp,
  unidades int,
  primary key (ean, nro, lado, altura, operador, instante),
  foreign key (ean, nro, lado, altura) references planograma(ean, nro, lado, altura) ON DELETE CASCADE,
  foreign key (operador, instante) references evento_reposicao(operador, instante) ON DELETE CASCADE
);
