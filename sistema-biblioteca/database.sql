-- ============================================================
--  Sistema de Biblioteca — Script SQL
--  Entrega Parcial 3 — CRUD Inicial
--  Equipe: Hezron Daniel | Leandro Caitano | Luilson Vieira
--  Polo: Sobradinho — BA
-- ============================================================

CREATE DATABASE IF NOT EXISTS biblioteca
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE biblioteca;

-- ------------------------------------------------------------
-- Tabela: categorias
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS categorias (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(100) NOT NULL,
    descricao   TEXT,
    criado_em   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela: autores
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS autores (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome            VARCHAR(150) NOT NULL,
    nacionalidade   VARCHAR(100),
    criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela: livros
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS livros (
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo          VARCHAR(200) NOT NULL,
    isbn            VARCHAR(20),
    ano             YEAR,
    sinopse         TEXT,
    qtd_total       INT UNSIGNED NOT NULL DEFAULT 1,
    qtd_disponivel  INT UNSIGNED NOT NULL DEFAULT 1,
    capa            VARCHAR(255),
    id_categoria    INT UNSIGNED,
    criado_em       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_livro_categoria FOREIGN KEY (id_categoria)
        REFERENCES categorias(id) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela: livro_autor (N:N)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS livro_autor (
    id_livro    INT UNSIGNED NOT NULL,
    id_autor    INT UNSIGNED NOT NULL,
    PRIMARY KEY (id_livro, id_autor),
    CONSTRAINT fk_la_livro FOREIGN KEY (id_livro) REFERENCES livros(id) ON DELETE CASCADE,
    CONSTRAINT fk_la_autor FOREIGN KEY (id_autor) REFERENCES autores(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela: usuarios
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome        VARCHAR(150) NOT NULL,
    email       VARCHAR(150) NOT NULL UNIQUE,
    senha       VARCHAR(255) NOT NULL,
    perfil      ENUM('admin','leitor') NOT NULL DEFAULT 'leitor',
    ativo       TINYINT(1) NOT NULL DEFAULT 1,
    criado_em   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Tabela: emprestimos
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS emprestimos (
    id                  INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_usuario          INT UNSIGNED NOT NULL,
    id_livro            INT UNSIGNED NOT NULL,
    data_emprestimo     DATE NOT NULL,
    data_prevista       DATE NOT NULL,
    data_devolucao      DATE,
    status              ENUM('em_aberto','devolvido','atrasado') NOT NULL DEFAULT 'em_aberto',
    criado_em           TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_emp_usuario FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
    CONSTRAINT fk_emp_livro   FOREIGN KEY (id_livro)   REFERENCES livros(id)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Dados iniciais de teste
-- ------------------------------------------------------------
INSERT INTO categorias (nome, descricao) VALUES
    ('Ficção Científica', 'Obras que exploram ciência e tecnologia futurista'),
    ('Literatura Brasileira', 'Clássicos e contemporâneos da literatura nacional'),
    ('Informática', 'Livros sobre programação, redes e tecnologia'),
    ('Romance', 'Narrativas focadas em relacionamentos humanos');

INSERT INTO autores (nome, nacionalidade) VALUES
    ('Machado de Assis', 'Brasileira'),
    ('Isaac Asimov', 'Americana'),
    ('Martin Fowler', 'Britânica'),
    ('José Saramago', 'Portuguesa');

INSERT INTO livros (titulo, isbn, ano, sinopse, qtd_total, qtd_disponivel, id_categoria) VALUES
    ('Dom Casmurro', '978-8535902778', 1899, 'Clássico da literatura brasileira de Machado de Assis.', 3, 3, 2),
    ('Fundação', '978-8576573081', 1951, 'Primeiro livro da série Fundação de Isaac Asimov.', 2, 2, 1),
    ('Refatoração', '978-8575228418', 2018, 'Como melhorar o design de código existente.', 2, 2, 3),
    ('O Alquimista', '978-8532511010', 1988, 'Obra de Paulo Coelho sobre sonhos e destino.', 4, 4, 4);

INSERT INTO livro_autor (id_livro, id_autor) VALUES
    (1, 1), (2, 2), (3, 3);

-- Usuário admin padrão (senha: admin123 — hash gerado com password_hash)
INSERT INTO usuarios (nome, email, senha, perfil) VALUES
    ('Administrador', 'admin@biblioteca.com',
     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');
