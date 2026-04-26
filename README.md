# 📚 Library Management System (Sistem Manajemen Perpustakaan)

A comprehensive web-based library management system built with Laravel 12 for managing books, user borrowing, collections, and reviews.

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat-square&logo=laravel" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-^8.2-777BB4?style=flat-square&logo=php" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/License-MIT-green?style=flat-square" alt="MIT License">
</p>

## 🎯 About This Project

This is a feature-rich library management system designed for educational purposes and production use. It provides functionalities for administrators and users to efficiently manage book inventories, borrowing transactions, user profiles, and book reviews.

## ✨ Features

### 👥 User Management

- User registration and authentication
- Role-based access control (Admin, Staff, User)
- User profile management and password change
- User data management by administrators

### 📖 Book Management

- Complete CRUD operations for books
- Book categorization system
- Book cover image storage
- Detailed book information (ISBN, author, publisher, pages, description)
- Stock management and availability tracking

### 📚 Lending System

- Book borrowing and return management
- Loan history tracking
- Automatic notification system
- Bukti (proof of transaction) generation

### 💝 Collections & Reviews

- Users can create personal book collections
- Book review and rating system
- Review management interface

### 📊 Admin Dashboard

- Comprehensive dashboard with statistics
- Book and category management
- User management and monitoring
- Borrowing/return management
- Report generation

### 🔔 Notifications

- Real-time notification system
- Borrowing status updates
- Return reminders

## 🛠️ Tech Stack

- **Framework**: Laravel 12
- **PHP Version**: 8.2+
- **Frontend**: Blade Templates, Vite
- **Database**: MySQL/MariaDB
- **PDF Generation**: Laravel DOMPDF
- **Authentication**: Laravel's built-in auth system

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL 5.7+ or MariaDB 10.3+
- Node.js & NPM (for frontend assets)

## 🚀 Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/yourusername/library-management-system.git
    cd library-management-system
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**

    ```bash
    npm install
    ```

4. **Create environment file**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Configure database**
   Update `.env` with your database credentials:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=library_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Run migrations and seeders**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

7. **Build front-end assets**

    ```bash
    npm run build
    ```

8. **Start the development server**
    ```bash
    php artisan serve
    ```

Access the application at `http://localhost:8000`

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/      # Application controllers
│   ├── Models/                 # Eloquent models
│   └── Providers/              # Service providers
├── database/
│   ├── migrations/             # Database migrations
│   ├── factories/              # Model factories
│   └── seeders/                # Database seeders
├── resources/
│   ├── views/                  # Blade templates
│   ├── css/                    # Stylesheets
│   └── js/                     # JavaScript files
├── routes/                     # Application routes
└── public/                     # Public assets
```

## 🔑 Default Users

After seeding, you can login with:

- **Admin**:
    - Email: `admin@example.com`
    - Password: `password`

- **Regular User**:
    - Email: `user@example.com`
    - Password: `password`

## 📇 Database Models

- **User** - System users with role-based permissions
- **Buku** (Book) - Book inventory
- **Kategori** (Category) - Book categories
- **KategoriBukuRelasi** - Book-Category relationship
- **Peminjaman** (Borrowing) - Lending records
- **Koleksi** (Collection) - User collections
- **Ulasan** (Review) - Book reviews and ratings
- **Notifikasi** (Notification) - System notifications

## 🔐 Security Features

- Laravel's built-in CSRF protection
- Password hashing with bcrypt
- Role-based authorization middleware
- SQL injection protection via Eloquent ORM
- Input validation and sanitization

## 📝 Available Commands

```bash
# Run tests
php artisan test

# Generate API documentation
php artisan tinker

# Clear application cache
php artisan cache:clear

# View application logs
tail -f storage/logs/laravel.log
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is open-source software licensed under the [MIT license](LICENSE).

## 👨‍💻 Author

Created as an educational project for learning Laravel framework best practices and building production-grade web applications.

## 📞 Support

For support, please open an issue on the [GitHub repository](https://github.com/yourusername/library-management-system/issues).

---

**Created with ❤️ using Laravel 12**
