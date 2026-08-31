-- Sistema de Biblioteca — Script SQL
-- Equipe: Hezron Daniel | Leandro Caitano | Luilson Vieira | Polo Sobradinho-BA

CREATE DATABASE IF NOT EXISTS biblioteca CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE biblioteca;

CREATE TABLE IF NOT EXISTS categorias (
    id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome      VARCHAR(100) NOT NULL,
    descricao TEXT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS autores (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome          VARCHAR(150) NOT NULL,
    nacionalidade VARCHAR(100),
    criado_em     TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS livros (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo         VARCHAR(200) NOT NULL,
    isbn           VARCHAR(20),
    ano            YEAR,
    sinopse        TEXT,
    qtd_total      INT UNSIGNED NOT NULL DEFAULT 1,
    qtd_disponivel INT UNSIGNED NOT NULL DEFAULT 1,
    capa           VARCHAR(255),
    id_categoria   INT UNSIGNED,
    criado_em      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS livro_autor (
    id_livro INT UNSIGNED NOT NULL,
    id_autor INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_livro, id_autor),
    FOREIGN KEY (id_livro) REFERENCES livros(id) ON DELETE CASCADE,
    FOREIGN KEY (id_autor) REFERENCES autores(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
    id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome      VARCHAR(150) NOT NULL,
    email     VARCHAR(150) NOT NULL UNIQUE,
    senha     VARCHAR(255) NOT NULL,
    perfil    ENUM('admin','leitor') NOT NULL DEFAULT 'leitor',
    ativo     TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS emprestimos (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario      INT UNSIGNED NOT NULL,
    id_livro        INT UNSIGNED NOT NULL,
    data_emprestimo DATE NOT NULL,
    data_prevista   DATE NOT NULL,
    data_devolucao  DATE,
    status          ENUM('em_aberto','devolvido','atrasado') NOT NULL DEFAULT 'em_aberto',
    criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    FOREIGN KEY (id_livro)   REFERENCES livros(id)
) ENGINE=InnoDB;

INSERT IGNORE INTO categorias (nome, descricao) VALUES
  ('Ficção Científica','Obras que exploram tecnologia e futuro'),
  ('Romance','Histórias de relacionamentos e sentimentos'),
  ('Técnico','Livros de programação, engenharia e ciências'),
  ('Literatura Brasileira','Clássicos e contemporâneos brasileiros');

INSERT IGNORE INTO autores (nome, nacionalidade) VALUES
  ('Machado de Assis','Brasileiro'),
  ('Clarice Lispector','Brasileira'),
  ('Isaac Asimov','Americano');

INSERT IGNORE INTO livros (titulo,isbn,ano,sinopse,qtd_total,qtd_disponivel,id_categoria) VALUES
  ('Dom Casmurro','978-85-359-0277-5',1899,'Clássico da literatura brasileira.',3,3,4),
  ('A Hora da Estrela','978-85-359-0278-2',1977,'Obra-prima de Clarice Lispector.',2,2,4),
  ('Fundação','978-85-359-0279-9',1951,'Saga épica de ficção científica.',4,4,1);

INSERT IGNORE INTO livro_autor VALUES (1,1),(2,2),(3,3);

INSERT IGNORE INTO usuarios (nome,email,senha,perfil) VALUES
  ('Administrador','admin@biblioteca.com',
   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','admin');
