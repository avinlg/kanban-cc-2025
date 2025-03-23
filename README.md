# Kanban CC 2025

Kanban CC 2025 (Coding Challenge 2025) is a modern Kanban board application.

## Technologies Used

- **Laravel 12**: Backend framework for building robust and scalable APIs.
- **PHP 8.3**: The latest version of PHP for improved performance and features.
- **Node.js 20**: JavaScript runtime for managing frontend dependencies and build processes.
- **Vue.js**: Progressive JavaScript framework for building interactive user interfaces.
- **TypeScript**: Superset of JavaScript for type-safe and maintainable code.
- **Tailwind CSS**: Utility-first CSS framework for rapid UI development.

## Prerequisites for dev

Before setting up the project, ensure you have the following installed:

- **PHP 8.3**
- **PHP 8.3 Extensions**:
    - `cli`
    - `sqlite3`
    - `common`
    - `fpm`
    - `zip`
    - `gd`
    - `mbstring`
    - `curl`
    - `xml`
    - `bcmath`
    - `mcrypt`
- **Composer** (latest version)
- **Node.js 20** (strictly version 20, as higher versions may cause installation errors)
- **npm** (comes with Node.js)
- **Git** for version control


## Getting Started
1. Clone the repository:
   ```bash
   git clone git@github.com:avinlg/kanban-cc-2025.git
   cd kanban-cc-2025
   ```

2. Install backend dependencies:
   ```bash
   composer install
   ```

3. Install frontend dependencies:
   ```bash
   npm install
   ```

4. Configure environment variables:
   - Copy `.env.example` to `.env` and update the necessary values.

5. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```

6. Start the development server:
   ```bash
   composer run dev
   ```

7. Build frontend assets:
   ```bash
   npm run build
   ```
