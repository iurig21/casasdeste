# Casas D'Este

Um website moderno para promover o trabalho da empresa de construção de casas Casas D'Este, sediada em Braga, Portugal.

Este projeto foi desenvolvido com [Laravel](https://laravel.com/) e utiliza templates Blade, lógica de back-end em PHP, CSS personalizado e JavaScript. Inclui um website responsivo para clientes e um backoffice seguro para administração.

---

## Índice

- [Sobre](#sobre)
- [Funcionalidades](#funcionalidades)
- [Backoffice (Painel de Administração)](#backoffice-painel-de-administração)
- [Capturas de Ecrã](#capturas-de-ecrã)
- [Tecnologias](#tecnologias)
- [Como Começar](#como-começar)
- [Estrutura do Projeto](#estrutura-do-projeto)
- [Variáveis de Ambiente](#variáveis-de-ambiente)

---

## Sobre

**Casas D'Este** apresenta a experiência e o portefólio de uma empresa de construção residencial de Braga. A plataforma disponibiliza aos potenciais clientes informação detalhada sobre serviços de construção, projetos concluídos e contactos para pedidos de orçamento.

---

## Funcionalidades

- **Design Responsivo Moderno:** Adapta-se de forma fluida a ecrãs de computador e dispositivos móveis.
- **Apresentação de Portefólio:** Exibe moradias e projetos com galerias e detalhes.
- **Apresentação da Empresa:** Páginas dedicadas a serviços, valores e apresentação da equipa.
- **Formulário de Contacto:** Permite aos visitantes pedir orçamentos personalizados ou mais informações.
- **Download de Brochura:** Os visitantes podem solicitar brochuras e enviar os seus dados de contacto.
- **Otimizado para SEO:** Utiliza marcação semântica e metadados para melhorar a visibilidade.
- **Gestão de Conteúdo Simples:** Construído com templates Blade organizados para facilitar manutenção e edição rápida.
- **Backoffice de Administração:** Gestão segura dos dados de leads (ver abaixo).

---

## Backoffice (Painel de Administração)

A Casas D'Este inclui um backoffice seguro, desenvolvido à medida para administradores:

- **Acesso:**  
  - Endpoint `/admin` para login (credenciais no `.env`: `ADMIN_USERNAME` / `ADMIN_PASSWORD`).
  - Rotas protegidas para administradores com autenticação por sessão e middleware personalizado.

- **Funcionalidades:**  
  - **Dashboard:** Mostra e gere pedidos de download de brochuras/leads com pesquisa e paginação.
  - **Pesquisa de Registos:** Filtra leads por nome, email ou telefone.
  - **Eliminar Registos:** Remove submissões com modal de confirmação.
  - **Terminar Sessão:** Encerra a sessão de administrador de forma segura.

- **Segurança:**  
  - O middleware restringe as rotas protegidas a administradores autenticados.
  - As credenciais são armazenadas em variáveis de ambiente através de `config/admin.php`.

- **Estilo:**  
  - Interface moderna construída com CSS personalizado e templates Blade para clareza e usabilidade.
  - Responsiva e acessível em vários dispositivos.

---

## Capturas de Ecrã

<!-- Adicionar capturas de ecrã reais na pasta `public/screenshots/` e atualizar os caminhos abaixo -->
![Página Inicial](public/screenshots/homepage.png)
![Portefólio](public/screenshots/portfolio.png)
![Formulário de Contacto](public/screenshots/contact.png)
![Dashboard Admin](public/screenshots/admin_dashboard.png)
![Login Admin](public/screenshots/admin_login.png)

---

## Tecnologias

- **Framework:** [Laravel](https://laravel.com/) (PHP)
- **Templates:** Blade
- **Estilização:** CSS, Tailwind
- **Base de Dados:** MySQL
- **Ferramentas de Build:** Composer, npm

---

## Como Começar

**Para correr uma cópia local do projeto:**

### 1. Pré-requisitos

- PHP 8.0 ou superior
- Composer
- Node.js e npm
- Uma base de dados (MySQL, MariaDB, SQLite, etc.)

### 2. Instalação

Clonar o repositório:
```sh
git clone https://github.com/iurig21/casasdeste.git
cd casasdeste
```

Instalar dependências PHP:
```sh
composer install
```

Instalar dependências JavaScript e compilar assets:
```sh
npm install
npm run dev   # Para desenvolvimento
# ou
npm run build # Para produção
```

### 3. Configurar Ambiente

Copiar `.env.example` para `.env`:
```sh
cp .env.example .env
```

Definir as variáveis de ambiente no `.env` (ver [Variáveis de Ambiente](#variáveis-de-ambiente) abaixo). Configure base de dados, mail, URL da aplicação e credenciais de administrador conforme necessário:

```env
ADMIN_USERNAME=seu_username_admin
ADMIN_PASSWORD=sua_password_segura
```

Gerar a chave da aplicação Laravel:
```sh
php artisan key:generate
```

### 4. Correr Migrações (se aplicável)

Se o site utilizar base de dados:
```sh
php artisan migrate
```

### 5. Servir a Aplicação

```sh
php artisan serve
```
Visite [http://localhost:8000](http://localhost:8000).

---

## Estrutura do Projeto

```text
casasdeste/
├── app/                # Lógica de back-end Laravel
├── bootstrap/
├── config/             # Ficheiros de configuração (ver config/admin.php para credenciais de admin)
├── database/
├── public/             # Assets públicos (index.php, imagens, CSS, etc.)
├── resources/
│   ├── views/          # Templates Blade
│   └── css/js          # Estilos/scripts fonte (opcional)
├── routes/             # Definições de rotas (web.php)
├── storage/
├── tests/
└── ...
```

---

## Variáveis de Ambiente

Principais variáveis a definir no `.env`:

```env
APP_NAME=CasasDEste
APP_ENV=local
APP_KEY=base64:...
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=casasdeste
DB_USERNAME=seu_utilizador_bd
DB_PASSWORD=sua_password_bd

ADMIN_USERNAME=seu_username_admin
ADMIN_PASSWORD=sua_password_segura

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=info@casasdeste.pt
MAIL_FROM_NAME="Casas D'Este"
```

Consulte a [documentação de configuração de ambiente do Laravel](https://laravel.com/docs/master/configuration) para mais informação.

---

_Mantido por [@iurig21](https://github.com/iurig21)_
