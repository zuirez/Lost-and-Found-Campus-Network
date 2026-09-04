<div align="center">
  <h1>AIUB Lost & Found Campus Network 🔍✨</h1>
  <p><i>A unified community platform for AIUB students and faculty to reconnect lost belongings with their owners swiftly and securely.</i></p>
</div>

---

## 📖 Overview

The **AIUB Lost & Found Campus Network** is an unofficial platform dedicated to the American International University-Bangladesh (AIUB) community. Thousands of students commute to the campus daily, and personal items are frequently misplaced. This web application provides a seamless, aesthetically pleasing, and highly secure centralized hub to report lost items and claim found items. 

Built from scratch, it entirely avoids bloated CSS frameworks and operates on a lightweight, custom **MVC (Model-View-Controller) Architecture** using raw PHP.

## 🚀 Key Features

* **Custom MVC Router**: Clean URLs (e.g., `/login` instead of `login.php`) managed by a robust front controller (`index.php`) and `.htaccess` rewrites.
* **Premium Glassmorphism UI/UX**: A highly modern, breathtaking visual interface featuring translucent blurred cards, glowing ambient backgrounds, smooth micro-animations, and vibrant color palettes.
* **Modular CSS Architecture**: Highly maintainable CSS structured into distinct modules (`base`, `components`, `layouts`, `pages`) glued together by a single `style.css` manifest.
* **Secure Aiven MySQL Database**: Enforces strict SSL/TLS verification through a secure PDO Singleton class.
* **Student-Centric Auth**: Registration interfaces explicitly designed for university attributes (Student ID, `.edu` email domains).

---

## 🛠️ Technology Stack

| Layer | Technologies Used |
| :--- | :--- |
| **Frontend UI** | HTML5, Vanilla CSS3 (Custom Variables, Flexbox, CSS Grid) |
| **Icons & Typography**| Phosphor Icons (CDN), Google Fonts (Inter) |
| **Backend Logic** | Raw PHP (8.0+) |
| **Architecture** | Custom MVC (Model-View-Controller) Pattern |
| **Database** | MySQL (Hosted securely on Aiven Free Tier) |
| **Server** | Apache (XAMPP/WAMP) with `mod_rewrite` enabled |

---

## 📁 Detailed Directory Structure

```text
Lost-and-Found-Campus-Network/
├── .htaccess                 # URL rewriting engine for clean MVC routing
├── index.php                 # Front Controller / App Entry Point
├── README.md                 # Project Documentation
├── config/                   
│   ├── config.php            # Environment & Database Credentials
│   └── ca.pem                # SSL Certificate required by Aiven MySQL
├── app/
│   ├── models/               # Data layer and database connection logic
│   │   └── Database.php      # PDO Singleton Wrapper enforcing TLS/SSL
│   ├── controllers/          # Business logic & View orchestrators (Upcoming)
│   └── views/                # Presentation layer (HTML mixed with PHP)
│       ├── auth/             # Authentication Views (login.php, register.php)
│       ├── home/             # Main landing feed and search dashboard
│       └── layouts/          # Reusable UI components (header.php, footer.php)
└── public/
    └── css/                  # Custom CSS Design System
        ├── style.css         # Master Manifest (handles all @imports)
        ├── base/             # variables.css (Design Tokens), global.css
        ├── components/       # buttons.css, cards.css (Reusable UI blocks)
        ├── layouts/          # header.css, footer.css (Structural styling)
        └── pages/            # home.css, auth.css (View-specific scopes)
```

---

## ⚙️ Setup & Installation Guide

To run this project locally, follow these steps meticulously:

### 1. Prerequisites
* **PHP 8.0 or higher** installed.
* **XAMPP / WAMP** (or any local Apache environment).
* **Git** installed on your machine.
* An **Aiven Cloud** account for the MySQL database.

### 2. Local Environment Setup
1. Clone the repository into your Apache `htdocs` (or `www`) folder:
   ```bash
   git clone https://github.com/zuirez/Lost-and-Found-Campus-Network.git
   ```
2. Start the **Apache** service from your XAMPP Control Panel.
3. Ensure the Apache module `mod_rewrite` is enabled (it usually is by default in XAMPP) to allow the `.htaccess` file to function.

### 3. Database Configuration (Aiven MySQL)
This project enforces secure database connections. You must configure Aiven properly:
1. Log into your Aiven Console and provision a **Free MySQL** instance.
2. Navigate to your database overview and copy the **Host**, **Port**, **User**, and **Password**.
3. Open `config/config.php` and paste your credentials into the respective `DB_` constants.
4. **CRITICAL:** Download the `ca.pem` (CA Certificate) from the Aiven connection dashboard.
5. Place the `ca.pem` file directly inside the `config/` directory.

### 4. Running the Application
Open your browser and navigate to:
```text
http://localhost/Lost-and-Found-Campus-Network/
```
The application dynamically calculates the `BASE_URL`, so it will function beautifully no matter what you name the parent folder.

---

## 🎨 The CSS Design System Explained

To maintain a premium aesthetic without the bloat of frameworks like Tailwind or Bootstrap, this project relies on a bespoke CSS architecture:

1. **Design Tokens (`variables.css`)**: Every color, shadow, border-radius, and spacing unit is stored as a CSS custom property (e.g., `--primary-color`, `--spacing-xl`). This allows for instant theme-wide adjustments.
2. **Component Isolation**: If a button looks broken, you only check `buttons.css`. If a card is misaligned, you only check `cards.css`.
3. **Cache Busting**: The `style.css` file includes dynamic PHP timestamps on the frontend to ensure you never get stuck viewing old CSS caches during development.

---

## 🤝 Contribution Guidelines

This is a community-driven project. If you are an AIUB student or developer looking to improve this platform:
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature/AmazingFeature`).
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`).
4. Push to the branch (`git push origin feature/AmazingFeature`).
5. Open a Pull Request.

---
*Disclaimer: This is an independent, student-led initiative and is not officially affiliated with the American International University-Bangladesh administration.*
