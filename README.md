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
