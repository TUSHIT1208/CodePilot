# 🚀 CodePilot — E-Learning Platform with Integrated Real-Time Code Debugger

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

CodePilot is a modern, feature-rich web-based learning management system (LMS) designed specifically for programmers and coding enthusiasts. Built with the **Laravel** framework, it bridges the gap between learning and practicing by providing a **split-screen interactive workspace**—enabling users to watch course videos and write/run/debug code in real-time.

---

## 🌟 Key Features

* **Interactive Code Debugger:** Features a split-screen workspace where learners can watch course videos and practice coding in a built-in real-time editor/debugger.
* **Role-Based Dashboards:** Distinct portals for **Admins** (control users, categories, and FAQs), **Instructors** (publish free/paid courses, manage media attachments, and track earnings), and **Learners** (resume courses, track video progress, and download certs).
* **Cart & Payment Integration:** Fully functional shopping cart and wishlist systems integrated with **Razorpay** payments and PDF invoice downloads.
* **Quizzes & Certifications:** Automatic evaluation of learner progress via MCQ tests, with dynamic PDF Certificate generation using **DomPDF** upon passing.

---

## 🛠️ Technology Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 10.x (PHP 8.1+) |
| **Frontend Utilities** | Blade Templates, HTML5, CSS3, JavaScript (ES6), jQuery / AJAX |
| **Styling Framework** | Bootstrap 5.x |
| **Build Tool** | Vite |
| **Database** | MySQL |
| **Core Libraries** | Razorpay SDK, Barryvdh DomPDF, Yajra DataTables, Mews Purifier |

---

## 🚀 Installation & Setup

Follow these steps to set up CodePilot on your local environment:

### Prerequisites
* PHP >= 8.1
* Composer
* Node.js & NPM
* MySQL Database Server
* Razorpay Test Account API Keys (Optional, for checkout functionality)

### Step-by-Step Setup

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/akshay-lad/code-pilot.git
   cd code-pilot
   ```

2. **Install Dependencies:**
   Install both backend PHP dependencies and frontend packages.
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment Variables:**
   Copy the example environment file and generate your application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup Database:**
   * Create a new database in MySQL (e.g., `new_codepilot_db`).
   * Update the database connection variables in your `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=new_codepilot_db
     DB_USERNAME=your_mysql_username
     DB_PASSWORD=your_mysql_password
     ```

5. **Run Migrations & Seeders:**
   Prepare the schema structure and populate it with essential roles, FAQs, and initial admin accounts:
   ```bash
   php artisan migrate --seed
   ```
   
   > 👤 **Default Seeder Admin Credentials:**
   > * **Email:** `CodePilot1213@gmail.com`
   > * **Password:** `admin123`

6. **Add Payment Keys (Razorpay Setup):**
   Open `.env` and configure your API details:
   ```env
   RAZORPAY_KEY=your_razorpay_key_here
   RAZORPAY_SECRET=your_razorpay_secret_here
   ```

7. **Compile Frontend Assets:**
   Run Vite dev server to compile style sheets and JavaScript files:
   ```bash
   npm run dev
   ```

8. **Start the Laravel Server:**
   Serve the application locally:
   ```bash
   php artisan serve
   ```
   Open your browser and navigate to `http://localhost:8000`.

---

## 🛠️ Handy Development Commands

* **Refresh Database & Seed:**
  ```bash
  php artisan migrate:fresh --seed
  ```
* **Clear Application Caches:**
  ```bash
  php artisan optimize:clear
  ```
* **Build Assets for Production:**
  ```bash
  npm run build
