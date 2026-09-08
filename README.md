<div align="center">

<img src="https://img.shields.io/badge/AIUB-Lost%20%26%20Found-4361ee?style=for-the-badge&logo=mapbox&logoColor=white" alt="AIUB Lost & Found">

# 🔍 AIUB Lost & Found Campus Network

**An unofficial, community-driven platform for AIUB students and faculty to reconnect lost belongings with their owners — swiftly and securely.**

[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-Aiven-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://aiven.io)
[![Apache](https://img.shields.io/badge/Apache-XAMPP-D22128?style=flat-square&logo=apache&logoColor=white)](https://apachefriends.org)
[![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)](LICENSE)

</div>

---

## 📖 Overview

The **AIUB Lost & Found Campus Network** is an unofficial platform built for the American International University–Bangladesh (AIUB) community. Thousands of students commute daily and personal items are frequently misplaced. This application provides a sleek, centralized hub to report lost items, claim found ones, and coordinate directly through threaded community comments.

Built entirely from scratch — no CSS frameworks, no boilerplate — using a custom **MVC (Model-View-Controller) architecture** in raw PHP with a premium glassmorphism dark UI.

---

## ✨ Feature Highlights

### 🔐 Authentication & User System
- Register with **Full Name**, **Student ID**, **University Email**, and an optional **profile photo**
- Login using **Email or Student ID** + password
- SweetAlert2-powered auth guards — unauthenticated users are redirected gracefully
- Role-based accounts: `student`, `admin`, `security`

### 📋 Lost & Found Posts
- Create **Lost** or **Found** reports with title, category, location, and description
- **Optional image uploads** stored in organized directories: `uploads/Lost/{student_id}/` or `uploads/Found/{student_id}/`
- **6 categories**: Electronics, ID Card, Wallet, Study Materials, Keys, Others
- Live **JavaScript category filter** on all feeds without page reloads
- Clicking post images navigates to the full post details page

### 💬 Comments & Discussion
- Threaded comment section on every post detail page
- **Edit** and **Delete** own comments via SweetAlert2 inline dialogs (no page navigation)
- Ownership enforced server-side on every action

### 👤 User Profile Dashboard
- Tabbed profile page with **3 sections**:
  - **My Posts** — view, edit, and delete your own reports with SweetAlert2 confirmation
  - **Account Info** — view full user details + change profile photo (instant upload)
  - **Change Password** — secure update with current password verification
- Profile photo stored at `uploads/profile/{student_id}/filename`
- Avatar displayed in the **navbar** next to the user's name

### 🎨 Premium UI/UX
- Full **glassmorphism dark mode** design
- Smooth micro-animations and hover effects throughout
- **Phosphor Icons** and **Google Fonts (Inter)** for premium typography
- Responsive layout aligned to a `1200px` content container matching the navbar
- **SweetAlert2** for every popup, confirmation, and notification

---

## 🛠️ Technology Stack

| Layer | Technologies |
| :--- | :--- |
| **Frontend** | HTML5, Vanilla CSS3 (Grid, Flexbox, Custom Properties) |
| **Icons & Fonts** | Phosphor Icons, Google Fonts (Inter) |
| **Alerts & Dialogs** | SweetAlert2 |
| **Backend** | Raw PHP 8.0+ |
| **Architecture** | Custom MVC (Front Controller Pattern) |
| **Database** | MySQL hosted on Aiven Cloud (SSL/TLS enforced) |
| **Server** | Apache via XAMPP with `mod_rewrite` |

---

## 📁 Project Structure

```text
Lost-and-Found-Campus-Network/
├── .htaccess                    # Clean URL rewriting rules
├── index.php                    # Front Controller & Router
├── scripts/
│   ├── setup_db.php             # Database schema installer
│   └── test_db.php              # Database connection tester
├── config/
│   ├── config.example.php       # Template for local config
│   ├── config.php               # DB credentials (gitignored)
│   └── ca.pem                   # Aiven SSL certificate (gitignored)
├── app/
│   ├── helpers/
│   │   └── session_helper.php   # flash(), requireAuth(), SweetAlert guards
│   ├── models/
│   │   ├── Database.php         # PDO Singleton with SSL/TLS enforcement
│   │   ├── User.php             # Register, login, profile, password management
│   │   ├── Post.php             # CRUD for lost/found posts
│   │   └── Comment.php          # CRUD for comments
│   ├── controllers/
│   │   ├── AuthController.php   # Login, register, logout, session creation
│   │   ├── PostsController.php  # Feed, post creation, comments
│   │   └── ProfileController.php# Profile dashboard, edit/delete posts, photo upload
│   └── views/
│       ├── layouts/             # header.php, footer.php (shared across all pages)
│       ├── auth/                # login.php, register.php
│       ├── posts/               # index.php, create.php, show.php
│       └── profile/             # index.php (tabbed), edit_post.php
└── public/
    ├── uploads/                 # All user uploads (gitignored)
    │   ├── Lost/{student_id}/   # Lost item images
    │   ├── Found/{student_id}/  # Found item images
    │   └── profile/{student_id}/# Profile pictures
    └── css/
        ├── style.css            # Master @import manifest
        ├── base/                # variables.css, global.css
        ├── components/          # buttons.css, cards.css
        ├── layouts/             # header.css, footer.css
        └── pages/               # home.css, auth.css
```

---

## ⚙️ Setup & Installation

### Prerequisites
- **PHP 8.0+**
- **XAMPP** (Apache + MySQL with `mod_rewrite` enabled)
- **Git**

---

### Step 1 — Clone the Repository
```bash
cd C:/xampp/htdocs
git clone https://github.com/zuirez/Lost-and-Found-Campus-Network.git
cd Lost-and-Found-Campus-Network
```

---

### Step 2 — Configure the Database (`config/config.php`)

Copy the example config and set your local credentials:
```bash
cp config/config.example.php config/config.php
```

Then open `config/config.php` and update it for **local XAMPP**:
```php
<?php

// XAMPP Localhost
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');           // Default XAMPP has no password
define('DB_NAME', 'lost_and_found');
define('DB_PORT', '3306');
```

> **Note:** `config/config.php` is gitignored — it will never be committed. Each developer maintains their own local copy.

---

### Step 3 — Create the Database

The database itself must be created manually before running the schema installer. Choose one of the two methods below:

**Option A — Via phpMyAdmin (GUI):**
1. Open `http://localhost/phpmyadmin`
2. Click **New** in the left sidebar
3. Enter `lost_and_found` as the database name
4. Set collation to `utf8mb4_unicode_ci`
5. Click **Create**

**Option B — Via MySQL CLI:**
```bash
C:/xampp/mysql/bin/mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS lost_and_found CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

---

### Step 4 — Run the Schema Installer (`scripts/setup_db.php`)

This script creates all required tables (`users`, `posts`, `comments`) using `CREATE TABLE IF NOT EXISTS` — it is safe to re-run at any time.

```bash
C:/xampp/php/php.exe scripts/setup_db.php
```

**Expected output:**
```
Table 'users' verified/created successfully.
Table 'posts' verified/created successfully.
Table 'comments' verified/created successfully.
```

---

### Step 5 — Test the Database Connection (`scripts/test_db.php`)

Run the connection test to confirm everything is wired up correctly:

```bash
C:/xampp/php/php.exe scripts/test_db.php
```

**Expected output:**
```
Connection Successful!
```

If you see `Connection Failed`, double-check your credentials in `config/config.php` and ensure the `lost_and_found` database was created in Step 3.

---

### Step 6 — Start Apache & Open the App

Start **Apache** and **MySQL** from the XAMPP Control Panel, then navigate to:
```
http://localhost/Lost-and-Found-Campus-Network/
```

> The application dynamically detects `BASE_URL` — it works regardless of the folder name.

---

### 🌐 Production / Remote Database (Aiven Cloud)

To use a remote MySQL instance (e.g., Aiven free tier) instead of localhost, update `config/config.php` with your remote credentials:

```php
<?php
define('DB_HOST', 'your-host.aivencloud.com');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'your_database_name');
define('DB_PORT', '3306');
```

Download the **CA Certificate** (`ca.pem`) from the Aiven connection dashboard and place it at `config/ca.pem` for SSL enforcement.

---

## 🎨 CSS Design System

The entire UI is built on a bespoke CSS architecture with no external framework dependency:

| File | Purpose |
| :--- | :--- |
| `variables.css` | Design tokens — colors, spacing, shadows, radii as CSS custom properties |
| `global.css` | Reset, base typography, scroll behavior |
| `buttons.css` | All button variants (`.btn-primary`, `.btn-outline`) |
| `cards.css` | Item card grid, badge styles, card metadata |
| `header.css` | Sticky navbar, mobile toggle, brand styles |
| `footer.css` | Multi-column footer grid |
| `auth.css` | Glassmorphism auth cards, input wrappers with icons |
| `home.css` | Hero section, quick stats, section headers |

Cache busting is handled by appending `?v=<?= time() ?>` to the stylesheet link in `header.php`.

---

## 🗺️ URL Route Map

| Route | Method | Controller | Action |
| :--- | :---: | :--- | :--- |
| `/` | GET | PostsController | Show all posts feed |
| `/posts/lost` | GET | PostsController | Filter Lost posts |
| `/posts/found` | GET | PostsController | Filter Found posts |
| `/posts/create` | GET/POST | PostsController | Create new post |
| `/posts/show/{id}` | GET | PostsController | Post detail + comments |
| `/posts/comment/{id}` | POST | PostsController | Add a comment |
| `/posts/edit_comment/{id}` | POST | PostsController | Edit a comment |
| `/posts/delete_comment/{id}` | GET | PostsController | Delete a comment |
| `/login` | GET/POST | AuthController | Login form & processing |
| `/register` | GET/POST | AuthController | Register form & processing |
| `/logout` | GET | AuthController | Destroy session |
| `/profile` | GET | ProfileController | Profile dashboard (tabbed) |
| `/profile/change_password` | POST | ProfileController | Update password |
| `/profile/edit_post/{id}` | GET/POST | ProfileController | Edit own post |
| `/profile/delete_post/{id}` | GET | ProfileController | Delete own post |
| `/profile/update_photo` | POST | ProfileController | Change profile picture |

---

## 🤝 Contributing

This is a community-driven project. AIUB students and developers are welcome to contribute:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/YourFeature`
3. Commit your changes: `git commit -m 'Add YourFeature'`
4. Push to the branch: `git push origin feature/YourFeature`
5. Open a Pull Request

---


