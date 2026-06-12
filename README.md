# 🚀 CodePilot — E-Learning Platform with Integrated Real-Time Code Debugger

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

CodePilot is a modern, feature-rich web-based learning management system (LMS) designed specifically for programmers and coding enthusiasts. Built with the **Laravel** framework, it bridges the gap between learning and practicing by providing a **split-screen interactive workspace**—enabling users to watch course videos and write/run/debug code in real-time.

---

## 🌟 Key Features

### 💻 1. Interactive Workspace & Code Debugger
* **Side-by-Side Learning:** A split-screen media player allows learners to watch course lectures on one side while having a dedicated coding workspace/debugger environment open on the other.
* **Smart Video Tracking:** Automatically tracks student watch progress (play, pause, and check points) via custom AJAX tracking to ensure progress persistence.

### 👥 2. Multi-Role Management System
The platform features three core user portals with distinct dashboards:
* **Admin Dashboard:**
  * Complete management of users, instructors, and categories.
  * System-wide configuration (FAQs, Learning Paths, categories, and subcategories).
  * Bulk operations (deletion/status toggling) using **Yajra DataTables** for smooth server-side rendering.
  * Financial audits and earning statements.
* **Instructor Portal:**
  * Quick course creator supporting free or paid courses.
  * Video and document/assignment attachment uploading with drag-and-drop ordering capabilities.
  * Real-time enrollment and earning tracking powered by visual analytics (enrollment charts).
* **Learner Portal:**
  * Intuitive course discovery interface filtered by category and level.
  * Interactive progress tracking dashboard with resume capabilities.
  * Custom shopping cart and wishlist management.

### 💳 3. Cart, Checkout & Razorpay Integration
* Complete shopping cart and wishlist system.
* Secure online payment transactions integrated with the **Razorpay Payment Gateway API**.
* Automated generation of transaction invoices available for preview or instant download.

### 📜 4. Quizzes & PDF Certifications
* Course-specific quiz examinations to test and validate learning outcomes.
* Automatic grading of MCQ-based test questionnaires.
* Dynamic Certificate of Completion generation (PDF format) using **Barryvdh DomPDF** upon successfully passing the course exam.

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
  ```

---

## 📝 License

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
