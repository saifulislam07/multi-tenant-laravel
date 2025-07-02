# Laravel Multi-Tenant App (Per-User Database)

This is a Laravel 12 project implementing **multi-tenancy** where each registered user gets their own **dedicated database**.

It includes:
- User registration and authentication (Laravel Breeze)
- Automatic database creation per user on registration
- Tenant-aware database connection switching (via middleware)
- Post management (create & list) stored in the user's own database
- Clean UI built with Tailwind CSS

---

## 🚀 Features

- 🧠 Per-user **tenant databases**
- 🔒 Authentication via Laravel Breeze
- ✍️ Users can create and manage posts
- ⚙️ Middleware-based tenant detection and connection
- ☁️ Clean and minimal Tailwind UI

---

## 📦 Tech Stack

- Laravel 12.x
- Laravel Breeze (Inertia + Blade or Vue)
- MySQL (for both central + tenant DBs)
- Tailwind CSS
- Git/GitHub for version control

---

## 🏗️ Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name


2. Install dependencies

composer install
npm install && npm run dev

3. Copy .env and set DB credentials

cp .env.example .env
php artisan key:generate


Update .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=central_db
DB_USERNAME=root
DB_PASSWORD=yourpassword


4. Run initial migrations

php artisan migrate


5. Start the app

php artisan serve


6. Register a new user
A new database will be created automatically with your username and user ID, and Laravel will run tenant-specific migrations into it (e.g. tenant_john_1).


🔄 Folder Structure

app/
├── Http/
│   ├── Controllers/
│   │   └── Tenant/
│   │       └── PostController.php
│   └── Middleware/
│       └── UseTenantConnection.php
database/
├── migrations/
│   └── tenant/
│       └── 202x_xx_xx_create_posts_table.php
resources/
├── views/
│   └── tenant/
│       └── posts/
│           ├── index.blade.php
│           └── create.blade.php


📌 Notes

    Each user has their own isolated database for data privacy and scalability.

    This is a simple starter template for multi-tenant apps using database per tenant strategy.

    For production, use queues and jobs for tenant DB creation + error handling.

📄 License

MIT – feel free to use and modify.
🤝 Author

Built with ❤️ by Md Saiful Islam
Feel free to connect on LinkedIn or GitHub.


---

## ✅ :
-  Saiful Islam and https://www.linkedin.com/in/saiful007.

