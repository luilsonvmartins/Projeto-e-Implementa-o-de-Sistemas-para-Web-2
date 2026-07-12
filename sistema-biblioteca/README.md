# 📚 Sistema de Biblioteca

Projeto Integrador — Análise e Desenvolvimento de Sistemas  
**Alunos:** Hezron Daniel M C Canturil
Leandro Caitano dos Santos
Luilson Vieira Martins
**Polo:** Sobradinho — BA

## Tecnologias
- PHP 8+
- MySQL (XAMPP)
- Arquitetura MVC
- PDO

## Como rodar localmente
1. Clone o repositório dentro de `C:\xampp\htdocs\`
2. Renomeie (ou clone como) `sistema-biblioteca`
3. Inicie o Apache e MySQL no XAMPP
4. Crie o banco: `CREATE DATABASE biblioteca;`
5. Acesse: `http://localhost/sistema-biblioteca/public`

## Estrutura de pastas
```
sistema-biblioteca/
├── app/
│   ├── controllers/   # Controllers (MVC)
│   ├── models/        # Models + Database
│   ├── views/         # Views por módulo
│   └── helpers.php    # Funções utilitárias
├── config/            # Configurações da aplicação e banco
├── public/            # Ponto de entrada (index.php + .htaccess)
├── routes/            # Sistema de rotas
└── README.md
```

## Entregas
| Entrega | Semana | Status |
|---------|--------|--------|
| EP1 — Planejamento e modelagem | Sem. 3 | ✅ |
| EP2 — Estrutura MVC e rotas    | Sem. 5 | ✅ |
| EP3 — CRUD Inicial             | Sem. 7 | 🔄 |
| EP4 — CRUD Completo            | Sem. 9 | ⏳ |
| EP5 — Autenticação             | Sem. 12| ⏳ |
| Projeto Final                  | Sem. 16| ⏳ |
