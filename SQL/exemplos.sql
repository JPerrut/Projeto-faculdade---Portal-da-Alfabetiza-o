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


-- 20 exemplos para usar na tabela de empresas, usar para testar css com mais clareza.

INSERT INTO empresas (nome_empresa, email, senha, cnpj, cep, estado, cidade, bairro, rua, numero, complemento, telefone, celular) VALUES 
('Empresa Alpha', 'alpha@email.com', 'senha123', '12.345.678/0001-95', '12345-678', 'SP', 'São Paulo', 'Centro', 'Rua Principal', '100', 'Sala 1', '(11) 1234-5678', '(11) 91234-5678'),
('Empresa Beta', 'beta@email.com', 'senha456', '23.456.789/0001-60', '23456-789', 'RJ', 'Rio de Janeiro', 'Zona Sul', 'Avenida Atlântica', '200', 'Apt 101', '(21) 2345-6789', '(21) 92345-6789'),
('Empresa Gama', 'gama@email.com', 'senha789', '34.567.890/0001-30', '34567-890', 'MG', 'Belo Horizonte', 'Savassi', 'Rua da Bahia', '300', 'Loja 2', '(31) 3456-7890', '(31) 93456-7890'),
('Empresa Delta', 'delta@email.com', 'senha012', '45.678.901/0001-10', '45678-901', 'PR', 'Curitiba', 'Centro Cívico', 'Avenida Cândido', '400', 'Andar 3', '(41) 4567-8901', '(41) 94567-8901'),
('Empresa Epsilon', 'epsilon@email.com', 'senha345', '56.789.012/0001-55', '56789-012', 'RS', 'Porto Alegre', 'Moinhos de Vento', 'Rua Padre Chagas', '500', 'Conj 10', '(51) 5678-9012', '(51) 95678-9012'),
('Empresa Zeta', 'zeta@email.com', 'senha678', '67.890.123/0001-72', '67890-123', 'BA', 'Salvador', 'Barra', 'Rua Marquês de Caravelas', '600', 'Bloco A', '(71) 6789-0123', '(71) 96789-0123'),
('Empresa Eta', 'eta@email.com', 'senha910', '78.901.234/0001-97', '78901-234', 'PE', 'Recife', 'Boa Viagem', 'Avenida Boa Viagem', '700', 'Cobertura', '(81) 7890-1234', '(81) 97890-1234'),
('Empresa Theta', 'theta@email.com', 'senha112', '89.012.345/0001-41', '89012-345', 'CE', 'Fortaleza', 'Meireles', 'Avenida Beira Mar', '800', 'Suite 15', '(85) 8901-2345', '(85) 98901-2345'),
('Empresa Iota', 'iota@email.com', 'senha213', '90.123.456/0001-82', '90123-456', 'GO', 'Goiânia', 'Setor Bueno', 'Rua T-63', '900', 'Sala 302', '(62) 9012-3456', '(62) 99012-3456'),
('Empresa Kappa', 'kappa@email.com', 'senha314', '01.234.567/0001-03', '01234-567', 'SC', 'Florianópolis', 'Centro', 'Rua Felipe Schmidt', '1000', 'Edifício Plaza', '(48) 0123-4567', '(48) 90123-4567'),
('Empresa Lambda', 'lambda@email.com', 'senha415', '12.345.678/0001-34', '12345-678', 'AM', 'Manaus', 'Adrianópolis', 'Rua Recife', '1100', 'Ap 1', '(92) 1234-5678', '(92) 91234-5678'),
('Empresa Mu', 'mu@email.com', 'senha516', '23.456.789/0001-76', '23456-789', 'DF', 'Brasília', 'Asa Norte', 'SGAN Quadra 601', '1200', 'Térreo', '(61) 2345-6789', '(61) 92345-6789'),
('Empresa Nu', 'nu@email.com', 'senha617', '34.567.890/0001-47', '34567-890', 'PA', 'Belém', 'Batista Campos', 'Rua Padre Eutíquio', '1300', 'Casa 4', '(91) 3456-7890', '(91) 93456-7890'),
('Empresa Xi', 'xi@email.com', 'senha718', '45.678.901/0001-28', '45678-901', 'MT', 'Cuiabá', 'Centro Sul', 'Avenida Mato Grosso', '1400', 'Sala 12', '(65) 4567-8901', '(65) 94567-8901'),
('Empresa Omicron', 'omicron@email.com', 'senha819', '56.789.012/0001-39', '56789-012', 'MS', 'Campo Grande', 'Centro', 'Rua 14 de Julho', '1500', 'Bloco B', '(67) 5678-9012', '(67) 95678-9012'),
('Empresa Pi', 'pi@email.com', 'senha920', '67.890.123/0001-40', '67890-123', 'SE', 'Aracaju', 'Atalaia', 'Avenida Santos Dumont', '1600', 'Sala 5', '(79) 6789-0123', '(79) 96789-0123'),
('Empresa Rho', 'rho@email.com', 'senha021', '78.901.234/0001-10', '78901-234', 'PB', 'João Pessoa', 'Tambaú', 'Rua Almirante Tamandaré', '1700', 'Cobertura', '(83) 7890-1234', '(83) 97890-1234'),
('Empresa Sigma', 'sigma@email.com', 'senha122', '89.012.345/0001-64', '89012-345', 'ES', 'Vitória', 'Praia do Canto', 'Rua Aleixo Neto', '1800', 'Apt 402', '(27) 8901-2345', '(27) 98901-2345'),
('Empresa Tau', 'tau@email.com', 'senha223', '90.123.456/0001-95', '90123-456', 'PI', 'Teresina', 'Centro', 'Rua Coelho de Resende', '1900', 'Sala 11', '(86) 9012-3456', '(86) 99012-3456'),
('Empresa Upsilon', 'upsilon@email.com', 'senha324', '01.234.567/0001-13', '01234-567', 'MA', 'São Luís', 'Renascença', 'Avenida Colares Moreira', '2000', 'Térreo', '(98) 0123-4567', '(98) 90123-4567');

-- Deve aparecer alguma falha de truncado, não tem problema, nao vai atrapalhar em nada.


INSERT INTO funcionarios (nome_func, rg, cpf, data_nasc, turno, escolaridade, sexo, cep, estado, cidade, bairro, rua, numero, complemento)
VALUES
    ('João Silva', '123456789', '123.456.789-00', '1985-06-15', 'Manhã', 'Ensino Médio Completo', 'Masculino', '12345-678', 'São Paulo', 'São Paulo', 'Centro', 'Rua A', '123', 'Apto 101'),
    ('Maria Oliveira', '987654321', '987.654.321-00', '1990-09-20', 'Tarde', 'Ensino Superior Completo', 'Feminino', '23456-789', 'Rio de Janeiro', 'Rio de Janeiro', 'Copacabana', 'Rua B', '456', 'Casa 202'),
    ('Carlos Pereira', '112233445', '112.233.445-66', '1982-01-10', 'Noite', 'Ensino Fundamental Completo', 'Masculino', '34567-890', 'Minas Gerais', 'Belo Horizonte', 'Savassi', 'Rua C', '789', 'Sala Comercial 303'),
    ('Ana Souza', '667788993', '667.788.990-11', '1995-03-30', 'Manhã', 'Ensino Médio Completo', 'Feminino', '45678-901', 'São Paulo', 'São Paulo', 'Vila Progredior', 'Rua D', '101', 'Apto 202'),
    ('Paulo Santos', '443322110', '443.322.110-22', '1987-07-25', 'Tarde', 'Ensino Superior Incompleto', 'Masculino', '56789-012', 'Paraná', 'Curitiba', 'Centro', 'Rua E', '234', 'Casa 505'),
    ('Cláudia Mendes', '223344557', '223.344.556-33', '1992-11-04', 'Noite', 'Ensino Fundamental Incompleto', 'Feminino', '67890-123', 'Bahia', 'Salvador', 'Barra', 'Rua F', '345', 'Apto 303'),
    ('Ricardo Alves', '334455667', '334.455.667-44', '1980-12-17', 'Manhã', 'Ensino Médio Completo', 'Masculino', '78901-234', 'Santa Catarina', 'Florianópolis', 'Centro', 'Rua G', '456', 'Sala 101'),
    ('Juliana Costa', '556677889', '556.677.889-55', '1991-08-19', 'Tarde', 'Ensino Superior Completo', 'Feminino', '89012-345', 'Rio Grande do Sul', 'Porto Alegre', 'Moinhos de Vento', 'Rua H', '567', 'Casa 202'),
    ('Lucas Almeida', '667788992', '667.788.990-22', '1993-02-14', 'Noite', 'Ensino Fundamental Completo', 'Masculino', '90123-456', 'Ceará', 'Fortaleza', 'Centro', 'Rua I', '678', 'Sala Comercial 404'),
    ('Patrícia Lima', '778899001', '778.899.001-66', '1990-05-07', 'Manhã', 'Ensino Médio Completo', 'Feminino', '12345-678', 'São Paulo', 'Santo André', 'Vila Alzira', 'Rua J', '789', 'Apto 303'),
    ('Fábio Costa', '889900112', '889.900.112-77', '1984-03-22', 'Tarde', 'Ensino Superior Completo', 'Masculino', '23456-789', 'Rio de Janeiro', 'Niterói', 'Centro', 'Rua K', '890', 'Casa 101'),
    ('Juliana Martins', '990011223', '990.011.223-88', '1994-12-13', 'Noite', 'Ensino Fundamental Completo', 'Feminino', '34567-890', 'São Paulo', 'São Bernardo do Campo', 'Jardim do Mar', 'Rua L', '901', 'Apto 404'),
    ('Carlos Lima', '223344556', '223.344.556-99', '1988-04-28', 'Manhã', 'Ensino Superior Incompleto', 'Masculino', '45678-901', 'Minas Gerais', 'Uberlândia', 'Centro', 'Rua M', '123', 'Sala 505'),
    ('Bruna Oliveira', '334455668', '334.455.667-11', '1996-11-15', 'Tarde', 'Ensino Médio Completo', 'Feminino', '56789-012', 'Espírito Santo', 'Vitória', 'Praia do Canto', 'Rua N', '234', 'Apto 505'),
    ('Ricardo Lima', '445566778', '445.566.778-22', '1986-07-07', 'Noite', 'Ensino Fundamental Completo', 'Masculino', '67890-123', 'Pernambuco', 'Recife', 'Boa Viagem', 'Rua O', '345', 'Casa 808'),
    ('Fernanda Rocha', '556677879', '556.677.889-33', '1992-01-10', 'Manhã', 'Ensino Superior Completo', 'Feminino', '78901-234', 'Alagoas', 'Maceió', 'Pajuçara', 'Rua P', '456', 'Apto 101'),
    ('Renato Souza', '667788998', '667.788.990-44', '1981-10-10', 'Tarde', 'Ensino Médio Incompleto', 'Masculino', '89012-345', 'Paraíba', 'João Pessoa', 'Centro', 'Rua Q', '567', 'Casa 303'),
    ('Karina Costa', '778899005', '778.899.001-55', '1990-02-20', 'Noite', 'Ensino Superior Completo', 'Feminino', '90123-456', 'Rio Grande do Norte', 'Natal', 'Centro', 'Rua R', '678', 'Apto 303'),
    ('Leandro Dias', '889800112', '889.900.112-66', '1993-08-18', 'Manhã', 'Ensino Médio Completo', 'Masculino', '12345-678', 'Sergipe', 'Aracaju', 'Jardim Centenário', 'Rua S', '789', 'Casa 808');



























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
