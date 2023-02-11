CREATE DATABASE task;
USE task;

CREATE TABLE funcionario (
    id_func INT PRIMARY KEY AUTO_INCREMENT,
    login VARCHAR(60) NOT NULL,
    senha VARCHAR(60) NOT NULL
);

CREATE TABLE paciente (
    nome VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    tel VARCHAR(11) PRIMARY KEY
);

CREATE TABLE agendamento (
    id_agend INT PRIMARY KEY AUTO_INCREMENT,
    tel VARCHAR(11) NOT NULL,
    datahora DATETIME NOT NULL,
    CONSTRAINT fk_agendamento_paciente FOREIGN KEY (tel) REFERENCES paciente(tel) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO funcionario (login, senha) VALUES
('edpinheiro', '827ccb0eea8a706c4c34a16891f84e7b');

INSERT INTO paciente (nome, email, tel) VALUES
('Pedro Souza', 'psouza@gmail.com', '22999990000'),
('Amanda Lima', 'alima@gmail.com', '22999991111'),
('Raul Gomes', 'raul_gomes@gmail.com', '22999992222');

INSERT INTO agendamento (tel, datahora) VALUES
('22999990000', '2023-02-20 12:30:00'),
('22999991111', '2023-02-25 16:00:00'),
('22999992222', '2023-03-01 07:20:00'),
('22999992222', '2022-03-01 07:20:00');
