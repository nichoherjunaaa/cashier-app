# 🧾 Cashier Transaction Management Application

Laravel + Vite + TailwindCSS

The **Cashier Transaction Management Application** is a web-based system built using the **Laravel** framework to help manage sales transactions, inventory stock, and periodic sales reports presented in tables and charts.

This application is suitable for retail stores, SMEs (UMKM), and as a learning project for Laravel-based web application development.

---

## 🚀 Key Features

### 📦 Product Management

* Add new products
* View product list
* Update and monitor product stock

### 💰 Transaction Management

* Sales transaction input
* Automatic total calculation
* Cash-in recording
* Transaction history

### 📊 Reports & Analytics

* Transaction reports:

  * Daily
  * Weekly
  * Monthly
* Data visualization using charts
* Best-selling product analysis
* Total revenue recap

---

## 🛠️ Tech Stack

* PHP >= 8.x
* Laravel
* MySQL / MariaDB
* Blade Template Engine
* TailwindCSS
* Vite
* NPM
* Chart.js

---

## 📂 Feature Structure

```
Cashier Application
├── Products
│   ├── Add Product
│   ├── View Products
│   └── Product Stock
├── Transactions
│   ├── New Transaction
│   ├── Transaction History
│   └── Cash In
├── Reports
│   ├── Daily
│   ├── Weekly
│   ├── Monthly
│   └── Charts
└── Analytics
    └── Best-Selling Products
```

---

## ⚙️ System Requirements

* PHP >= 8.x
* Composer
* Node.js & NPM
* MySQL / MariaDB
* Git

---

## 🔧 Installation & Configuration

### 1. Clone Repository

```bash
git clone https://github.com/username/repository-name.git
cd repository-name
```

### 2. Install Backend Dependencies

```bash
composer install
```

### 3. Environment Configuration

```bash
cp .env.example .env
```

Edit the `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cashier_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migration

```bash
php artisan migrate
```

### 6. Install Frontend Dependencies

```bash
npm install
```

### 7. Run Vite Development Server

```bash
npm run dev
```

### 8. Run Laravel Development Server

```bash
php artisan serve
```

Access the application via browser:

```
http://127.0.0.1:8000
```
