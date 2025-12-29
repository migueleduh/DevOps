CREATE DATABASE inovatech_db;
CREATE USER 'admin'@'%' IDENTIFIED BY 'abc123';
GRANT ALL PRIVILEGES ON inovatech_db.* TO 'admin';

USE inovatech_db;

/* Agora, criamos nossa tabela de funcionarios (REQ04).
*/
CREATE TABLE IF NOT EXISTS funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    data_admissao DATE NOT NULL
);
