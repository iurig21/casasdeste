# Casas D'Este

A modern website to promote the work of the house construction company, Casas D'Este, based in Braga, Portugal.

This project is built with [Laravel](https://laravel.com/) and leverages Blade templating, PHP back-end logic, custom CSS, and JavaScript. It features a responsive website for clients and a secure backoffice (admin panel) for managing contact leads.

---

## Table of Contents

- [About](#about)
- [Features](#features)
- [Backoffice (Admin Panel)](#backoffice-admin-panel)
- [Screenshots](#screenshots)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
- [Project Structure](#project-structure)
- [Environment Variables](#environment-variables)
- [Deployment](#deployment)

---

## About

**Casas D'Este** showcases the experience and portfolio of a residential construction company from Braga. The platform provides potential clients with detailed information about construction services, highlights completed projects, and serves as a direct channel for contact and inquiries.

---

## Features

- **Modern Responsive Design:** Adapts seamlessly to desktop and mobile screens.
- **Portfolio Display:** Showcases houses and projects with galleries and details.
- **Company Showcase:** Dedicated pages for services, values, and team introduction.
- **Contact Form:** Lets visitors reach out for custom project quotes or information.
- **Brochure Download:** Visitors can request brochures and submit their contact data.
- **SEO-Friendly:** Uses semantic markup and meta data for discoverability.
- **Easy Content Management:** Built with organized Blade templates for maintainability and quick editing.
- **Admin Backoffice:** Secure management of lead data (see below).

---

## Backoffice (Admin Panel)

Casas D'Este includes a secure, custom-built backoffice for administrators:

- **Access:**  
  - `/admin` endpoint for login (credentials from `.env`: `ADMIN_USERNAME` / `ADMIN_PASSWORD`).
  - Admin-protected routes using session authentication and custom middleware.

- **Features:**  
  - **Dashboard:** Displays and manages brochure download requests/leads with search and pagination.
  - **Record Search:** Filter leads by name, email, or phone.
  - **Delete Records:** Remove submissions with confirmation modal.
  - **Logout:** Securely terminate the admin session.

- **Security:**  
  - Middleware restricts protected routes to logged-in admins.
  - Credentials are stored in environment variables via `config/admin.php`.

- **Styling:**  
  - Modern UI built with custom CSS and Blade templates for clarity and usability.
  - Responsive and accessible for use across devices.

---

## Screenshots

<!-- Add actual screenshots in the `public/screenshots/` folder and update paths below -->
![Homepage](public/screenshots/homepage.png)
![Portfolio](public/screenshots/portfolio.png)
![Contact Form](public/screenshots/contact.png)
![Admin Dashboard](public/screenshots/admin_dashboard.png)
![Admin Login](public/screenshots/admin_login.png)

---

## Tech Stack

- **Framework:** [Laravel](https://laravel.com/) (PHP)
- **Templating:** Blade
- **Styling:** CSS,Tailwind
- **Database:** MySQL
- **Build Tools:** Composer, npm

---

## Getting Started

**To get a local copy up and running:**

### 1. Prerequisites

- PHP 8.0 or higher
- Composer
- Node.js and npm
- A database (MySQL, MariaDB, SQLite, etc.)

### 2. Installation

Clone the repository:
```sh
git clone https://github.com/iurig21/casasdeste.git
cd casasdeste
```

Install PHP dependencies:
```sh
composer install
```

Install JavaScript dependencies and compile assets:
```sh
npm install
npm run dev   # For development
# or
npm run build # For production
```

### 3. Configure Environment

Copy `.env.example` to `.env`:
```sh
cp .env.example .env
```

Set your environment variables in `.env` (see [Environment Variables](#environment-variables) below). Set your database, mail, application URL, and admin credentials as needed:

```env
ADMIN_USERNAME=your_admin_username
ADMIN_PASSWORD=your_secure_password
```

Generate Laravel application key:
```sh
php artisan key:generate
```

### 4. Run Migrations (if applicable)

If your site uses a database:
```sh
php artisan migrate
```

### 5. Serve the Application

```sh
php artisan serve
```
Visit [http://localhost:8000](http://localhost:8000).

---

## Project Structure

```
casasdeste/
├── app/                # Laravel backend logic
├── bootstrap/
├── config/             # Configuration files (see config/admin.php for admin credentials)
├── database/
├── public/             # Public assets (index.php, images, CSS, etc.)
├── resources/
│   ├── views/          # Blade templates
│   └── css/js          # Source styles/scripts (optionally)
├── routes/             # Route definitions (web.php)
├── storage/
├── tests/
└── ...
```

---

## Environment Variables

Key variables to set in `.env`:

```env
APP_NAME=CasasDEste
APP_ENV=local
APP_KEY=base64:...
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=casasdeste
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

ADMIN_USERNAME=your_admin_username
ADMIN_PASSWORD=your_secure_password

MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=info@casasdeste.pt
MAIL_FROM_NAME="Casas D'Este"
```

Refer to Laravel’s [environment configuration documentation](https://laravel.com/docs/master/configuration) for more info.

---

## Deployment

- For production, ensure you:
    - Run `php artisan config:cache` and `php artisan route:cache`
    - Use `npm run build` for minified frontend assets
    - Point your web server (e.g., Nginx, Apache) to the `public/` directory
    - Set file/folder permissions as per Laravel's [deployment guide](https://laravel.com/docs/master/deployment)
    - Configure production-ready admin credentials and environment variables


Questions, suggestions, or need a quote? Reach out!

---

_Maintained by [@iurig21](https://github.com/iurig21)_
