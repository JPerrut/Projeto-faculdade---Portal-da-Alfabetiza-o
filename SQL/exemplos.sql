--Criar o banco de dados do site.
CREATE DATABASE portal;
USE portal;
CREATE TABLE empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY, 
    nome_empresa VARCHAR(50) NOT NULL,
    cnpj CHAR(30) UNIQUE NOT NULL,
    senha CHAR(255) NOT NULL, --Nunca limitar
    email VARCHAR(255) UNIQUE NOT NULL,
    cep CHAR(20) NOT NULL,
    estado CHAR(10) NOT NULL,
    cidade VARCHAR (50) NOT NULL,
    bairro VARCHAR(50) NOT NULL, 
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR (20),
    complemento VARCHAR(50),
    telefone VARCHAR(20),
    celular VARCHAR(20),
    is_admin TINYINT(1) NOT NULL DEFAULT 0, -- 1 para admin, 0 para usuários comuns
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE escola (
    id_escola INT AUTO_INCREMENT PRIMARY KEY,
    nome_escola VARCHAR (80) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    hora_aula TIME NOT NULL,
    cep CHAR(20) NOT NULL,
    estado CHAR(10) NOT NULL,
    cidade VARCHAR (30) NOT NULL,
    bairro VARCHAR(50) NOT NULL, 
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR (20),
    complemento VARCHAR(50),
    telefone VARCHAR(20),
    celular VARCHAR(20)
);

CREATE TABLE funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT,
    id_escola INT,
    nome_func VARCHAR(80) NOT NULL,
    rg VARCHAR(20) UNIQUE NOT NULL,
    cpf VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    turno VARCHAR(20) NOT NULL,
    sexo VARCHAR(20)NOT NULL,
    escolaridade VARCHAR(20),
    data_nasc DATE NOT NULL,
    cep CHAR(20) NOT NULL,
    estado CHAR(10) NOT NULL,
    cidade VARCHAR (30) NOT NULL,
    bairro VARCHAR(50) NOT NULL, 
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR (20),
    complemento VARCHAR(50),
    FOREIGN KEY (id_escola) REFERENCES escola(id_escola),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
);

INSERT INTO empresas (nome_empresa, email, senha, is_admin) VALUES ('Admin', 'admin@admin.com', '$2y$10$AMM9dGPwEpIVyPb1jt9iVuEoOLyELDmiiBmcv05anfjzF1gOqgIo2', 1);






























-- Criação do banco de dados
CREATE DATABASE portal;
USE portal;

-- Criação da tabela 'empresas'
CREATE TABLE empresas (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome_empresa VARCHAR(50) NOT NULL,
    cnpj VARCHAR(20) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    email VARCHAR(255) NOT NULL,
    cep VARCHAR(20) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR(10),
    complemento VARCHAR(50),
    telefone VARCHAR(20) NOT NULL,
    celular VARCHAR(20) NOT NULL,
    is_admin TINYINT(1) DEFAULT 0
);

-- Criação da tabela 'funcionarios'
CREATE TABLE funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    id_empresa INT NOT NULL,
    nome_func VARCHAR(80) NOT NULL,
    rg VARCHAR(12) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(255) NOT NULL,
    turno VARCHAR(10) NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    escolaridade VARCHAR(20) NOT NULL,
    data_nasc VARCHAR(30) NOT NULL,
    cep VARCHAR(20) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    bairro VARCHAR(50) NOT NULL,
    rua VARCHAR(50) NOT NULL,
    numero VARCHAR(10),
    complemento VARCHAR(50),
    FOREIGN KEY (id_empresa) REFERENCES empresas(id_empresa)
        ON DELETE CASCADE ON UPDATE CASCADE
);
