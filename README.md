# 🗳️ Student Voting System

Welcome to the **Student Voting System**, a web-based application built with **Laravel** for managing and conducting secure, efficient student elections.

## 📌 Features

- 🗳️ Create and manage elections
- 🪪 Register candidates and assign them to positions
- 👨‍🎓 Student voter registration and authentication
- 📥 Secure vote casting (one vote per position)
- 📊 Real-time vote counting and results display
- 🧑‍💼 Admin dashboard to manage students, elections, candidates, and results

## 🧱 Tech Stack

- **Framework:** Laravel
- **Frontend:** Blade, Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Auth
- **Additional:** Modal forms, date filtering, and user roles (Admin, Student)

## 🚀 Getting Started

Follow these steps to set up the project on your local machine.

### 1. Clone the Repository

```bash
git clone https://github.com/Jherald-Vibar/Student-Voting-System.git
cd Student-Voting-System

### 2. Install Dependencies
composer install
npm install && npm run dev

### 3. Set Up Environment
cp .env.example .env
php artisan key:generate

php artisan migrate
php artisan db:seed

php artisan serve
