CREATE DATABASE IF NOT EXISTS loja;

USE loja;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);


CREATE TABLE estoque (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL DEFAULT 0
);


ALTER TABLE usuarios ADD COLUMN is_admin TINYINT(1) DEFAULT 0;

UPDATE usuarios 
SET is_admin = 1 
WHERE email = 'admin@example.com';



INSERT INTO estoque (nome, quantidade) VALUES
('Camisa de algodão, estampada VIAOUR', 10),
('Camisa de algodão, estampada listrada', 15),
('Camisa de algodão, estampada paris', 20),
('Camisa de algodão, estampada', 25),
('Camisa de algodão, estampada paris', 30),
('Camisa social marrom Manga Curta', 18),
('Camisa de botão preta', 12),
('Camisa social azul Manga Curta', 20),
('Camisa social branca de botão', 22),
('Camisa de algodão Manga Curta', 17),
('Camisa de algodão preta', 19),
('Camisa de algodão branca', 23);
