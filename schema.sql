CREATE DATABASE IF NOT EXISTS catalogo_avioes;

USE catalogo_avioes;

CREATE TABLE colecao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modelo VARCHAR(100) NOT NULL,        -- Ex: 14 Bis, B747-400
    fabricante VARCHAR(100) NOT NULL,    -- Ex: AirBus, Boeing, Embraer
    ano_lancamento INT,                  -- Ex: 1906, 1969
    raridade ENUM('Comum', 'Pouco Comum', 'Raro', 'Épico', 'Lendário') DEFAULT 'Comum',
    categoria ENUM('Civil', 'Militar') DEFAULT 'Civil',
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);