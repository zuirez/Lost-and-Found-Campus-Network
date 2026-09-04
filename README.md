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
├── setup_db.php                 # Database schema installer
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
- **XAMPP / WAMP** (Apache with `mod_rewrite` enabled)
- **Git**
- An **Aiven Cloud** account (free tier) for MySQL

### Step 1 — Clone the Repository
```bash
cd C:/xampp/htdocs
git clone https://github.com/zuirez/Lost-and-Found-Campus-Network.git
cd Lost-and-Found-Campus-Network
```

### Step 2 — Configure the Database
1. Log into [Aiven Console](https://console.aiven.io) and provision a free MySQL instance.
2. Copy the connection details (**Host**, **Port**, **User**, **Password**, **Database name**).
3. Copy the config template and fill in your credentials:
   ```bash
   cp config/config.example.php config/config.php
   ```
4. Download the **CA Certificate** (`ca.pem`) from the Aiven connection dashboard and place it in `config/ca.pem`.

### Step 3 — Run the DB Schema Installer
```bash
php setup_db.php
```
This creates the `users`, `posts`, and `comments` tables with the full schema.

### Step 4 — Start Apache & Open the App
Start Apache from the XAMPP Control Panel, then navigate to:
```
http://localhost/Lost-and-Found-Campus-Network/
```

> The application dynamically detects `BASE_URL` — it works regardless of the folder name.

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


