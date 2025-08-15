# 🎲 Sistema de Gerenciamento de Personagens RPG

Um sistema web completo para criação e gerenciamento de fichas de personagens de RPG, desenvolvido em PHP com arquitetura MVC.

![RPG System](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

## 👥 Equipe de Desenvolvimento

- **Alana Cristina Martens**
- **Camilli Frigeri Feliz**
- **Mariela Barbosa da Silva**
- **Matheus Müller dos Santos**
- **Vitor Manoel Rodrigues Carvalho**
- **Samantha de Souza Andrade**

## 🎯 Sobre o Projeto

O **Sistema de Gerenciamento de Personagens RPG** é uma aplicação web que permite aos jogadores de RPG criar, gerenciar e acompanhar suas fichas de personagens de forma digital. O sistema oferece uma interface intuitiva para cadastrar personagens com todos os atributos clássicos de RPG, facilitando a organização durante as sessões de jogo.

## ⚡ Funcionalidades

### 🔐 Sistema de Autenticação

- **Cadastro de usuários** com validação de email
- **Login seguro** com hash de senha
- **Sessões** baseadas em cookies
- **Validação** de formulários

### 👤 Gerenciamento de Personagens

- **Criar personagens** com atributos completos
- **Visualizar fichas** detalhadas
- **Editar** informações dos personagens
- **Excluir** personagens
- **Listar** todos os personagens do usuário

### 📊 Atributos de Personagem

- **Nome** e **Classe**
- **Nível** do personagem
- **Atributos físicos**: Força, Destreza, Constituição
- **Atributos mentais**: Inteligência, Sagacidade, Carisma

### 🎨 Interface Responsiva

- Design temático de RPG
- Interface responsiva e intuitiva
- Efeitos visuais e animações CSS
- Background temático com castelo medieval

## 🛠 Tecnologias Utilizadas

### Backend

- **PHP 8.0+** - Linguagem principal
- **MySQL** - Banco de dados relacional
- **PDO** - Abstração de banco de dados
- **Arquitetura MVC** - Padrão de projeto

### Frontend

- **HTML5** - Estrutura das páginas
- **CSS3** - Estilização e responsividade
- **JavaScript** - Interatividade (script.js vazio, pronto para expansão)

### Recursos

- **Namespaces PHP** - Organização do código
- **Autoload** - Carregamento automático de classes
- **Prepared Statements** - Segurança contra SQL Injection
- **Password Hashing** - Criptografia de senhas

## 🏗 Arquitetura

O projeto segue o padrão **MVC (Model-View-Controller)**:

```
App/
├── Controllers/     # Lógica de controle
├── Models/         # Modelos de dados
├── Dal/            # Data Access Layer (DAO)
├── Views/          # Páginas HTML/PHP
├── includes/       # Componentes reutilizáveis
├── helpers/        # Utilitários (autoload)
└── assets/         # CSS, JS, imagens
```

### Fluxo de Dados

1. **Requisição** → `index.php` (Router)
2. **Roteamento** → View apropriada
3. **Controller** → Processa lógica de negócio
4. **Model/DAO** → Interage com banco de dados
5. **Resposta** → View renderizada

## 📋 Pré-requisitos

- **PHP 8.0 ou superior**
- **MySQL 5.7 ou superior**
- **Servidor web** (Apache/Nginx)
- **phpMyAdmin** (recomendado para gerenciamento do BD)

### Extensões PHP necessárias:

- `pdo`
- `pdo_mysql`
- `mysqli`

## 🚀 Instalação

### 1. Clone o repositório

```bash
git clone [url-do-repositorio]
cd sistema-rpg
```

### 2. Configure o servidor web

- Coloque os arquivos na pasta do servidor web (htdocs, www, etc.)
- Configure um virtual host (opcional)

## 🗄 Configuração do Banco de Dados

### 1. Crie o banco de dados

Execute o script SQL fornecido:

```sql
-- Usar o arquivo sql_db.sql
CREATE DATABASE IF NOT EXISTS jogo_rpg;
USE jogo_rpg;

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de personagens
CREATE TABLE IF NOT EXISTS personagem (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    classe VARCHAR(50) NOT NULL,
    nivel INT NOT NULL DEFAULT 1,
    usuario_id INT NOT NULL,
    forca INT DEFAULT 0,
    destreza INT DEFAULT 0,
    constituicao INT DEFAULT 0,
    inteligencia INT DEFAULT 0,
    sagacidade INT DEFAULT 0,
    carisma INT DEFAULT 0,
    FOREIGN KEY (usuario_id) REFERENCES usuario(id) ON DELETE CASCADE
);
```

### 2. Configure a conexão

Edite o arquivo `Dal/conn.php` se necessário:

```php
private static string $host = '127.0.0.1';
private static int $port = 3307;  // Altere para 3306 se necessário
private static string $user = 'root';
private static string $password = '';  // Defina sua senha
private static string $dbName = 'jogo_rpg';
```

## 📁 Estrutura do Projeto

```
sistema-rpg/
│
├── index.php                 # Arquivo principal (router)
├── sql_db.sql               # Script de criação do banco
│
├── Controllers/
│   ├── PersonagemController.php
│   └── UsuarioController.php
│
├── Models/
│   ├── Personagem.php
│   └── Usuario.php
│
├── Dal/
│   ├── conn.php            # Conexão com banco
│   ├── personagemDAO.php   # CRUD de personagens
│   └── usuarioDAO.php      # CRUD de usuários
│
├── Views/
│   ├── home.php           # Página inicial
│   ├── login.php          # Formulário de login
│   ├── cadastro.php       # Cadastro de usuário
│   ├── listaPersonagem.php # Lista personagens
│   ├── personagemForm.php  # Criar personagem
│   ├── editarPersonagem.php # Editar personagem
│   ├── perfilPersonagem.php # Ver detalhes
│   ├── deletarPersonagem.php # Excluir personagem
│   └── 404.php            # Página de erro
│
├── includes/
│   ├── header.php         # Cabeçalho comum
│   └── footer.php         # Rodapé comum
│
├── helpers/
│   └── autoload.php       # Carregamento automático
│
└── assets/
    ├── style.css          # Estilos principais
    ├── script.js          # JavaScript (vazio)
    └── background.png     # Imagem de fundo
```

## 🎮 Como Usar

### 1. Acesse o sistema

```
http://localhost/sistema-rpg
```

### 2. Registre-se

1. Clique em **"Login"**
2. Clique em **"Registre-se"**
3. Preencha: Nome, Email, Senha
4. Confirme a senha

### 3. Faça login

1. Use email e senha cadastrados
2. Será redirecionado para página inicial

### 4. Gerencie personagens

1. Acesse **"Fichas"** no menu
2. Clique **"Criar Personagem"**
3. Preencha todos os atributos:
   - Nome do personagem
   - Classe (Guerreiro, Mago, etc.)
   - Nível inicial
   - Atributos (Força, Destreza, etc.)

### 5. Visualize e edite

- **Ver detalhes**: Clique no nome do personagem
- **Editar**: Botão "Editar" na página do personagem
- **Excluir**: Botão "Excluir" (com confirmação)

## 🔗 API Endpoints (Routes)

O sistema usa roteamento por parâmetro GET `page`:

| Route                      | Arquivo               | Descrição           |
| -------------------------- | --------------------- | ------------------- |
| `?page=home`               | home.php              | Página inicial      |
| `?page=login`              | login.php             | Formulário de login |
| `?page=registrar`          | cadastro.php          | Registro de usuário |
| `?page=personagens`        | listaPersonagem.php   | Lista personagens   |
| `?page=criar_personagem`   | personagemForm.php    | Criar personagem    |
| `?page=perfil_personagem`  | perfilPersonagem.php  | Ver personagem      |
| `?page=editar_personagem`  | editarPersonagem.php  | Editar personagem   |
| `?page=deletar_personagem` | deletarPersonagem.php | Excluir personagem  |

### Parâmetros adicionais:

- `?page=perfil_personagem&personagem=ID` - Ver personagem específico
- `?page=editar_personagem&id=ID` - Editar personagem específico
- `?page=deletar_personagem&id=ID` - Excluir personagem específico
