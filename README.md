# uSphere - Modern User Management System

## Description

This is a modern PHP application that demonstrates a simple user management system. The application features:

- A clean, responsive interface built with Bootstrap
- A dynamic table displaying user information (name, email, city, phone)
- Real-time city-based filtering functionality
- Form validation for new user entries
- AJAX-powered form submissions
- A custom PHP framework with MVC-like structure

The project serves as a practical example of PHP development best practices, including:
- Object-oriented programming with a custom framework
- Database operations with MySQL
- Frontend-backend integration
- Form handling and validation
- Modern UI/UX implementation

## Installation

1. Install and configure MySQL (see MySQL Setup section below)
2. Initialize the database and import all migrations by running the provided script:
   ```sh
   ./database/init-db.sh
   ```
   This script will create the database, user, and import all `.sql` migrations automatically.  
   It works both inside Docker and when run manually from the project root.
3. Copy [database](config/database) to [database.php](config/database.php) and configure your database connection settings in this file

### MySQL Setup on macOS

1. Install MySQL using Homebrew:
   ```sh
   brew install mysql
   ```
2. Start MySQL service:
   ```sh
   brew services start mysql
   ```
3. Verify MySQL is running:
   ```sh
   brew services list
   ```

### Database Initialization

You can initialize the database and import all migrations with a single command:
```sh
./database/init-db.sh
```
This script will:
- Create the database (if it doesn't exist)
- Create the user and grant privileges (if needed)
- Import all `.sql` migration files in order

> You no longer need to run manual SQL commands for setup—just use the script!

## Running the Application

### Local Development

Directly with PHP:
```sh
php -S localhost:8080
```

Or through Docker Compose:
```sh
docker-compose up
```

Rebuild the images with `docker-compose up --build` after bringing the services down, including volumes removal with `docker-compose down -v`.

### Production Deployment

1. Ensure initially that you have the ClearDB add-on (Heroku's MySQL) available and integrated (easy to do from the UI)
2. Create a new app, let's say `bs-php-app`
3. Push code and release the `web` service (this will build and upload images)
4. Ensure proper configuration via environment variables (to access the DB)

```sh
# Login and create your first app
heroku login
heroku create bs-php-app

# Tell Heroku to do a Docker-based deployment
heroku container:login
heroku stack:set container -a bs-php-app
heroku labs:enable --app=bs-php-app runtime-new-layer-extract  # fixes Apache
heroku container:push web --app bs-php-app
heroku container:release web --app bs-php-app

# Configure remote DB access via env vars credentials
heroku config:set MYSQL_USER=b********d4c --app bs-php-app
heroku config:set MYSQL_PASSWORD=c7******5 --app bs-php-app
heroku config:set MYSQL_HOST=us-cluster-east-01.k8s.cleardb.net --app bs-php-app
heroku config:set MYSQL_DATABASE=heroku_1f6******4f5 --app bs-php-app
```

> Make sure to manually import the SQL dumps in the remote DB (not automated)

## Development Tasks

For a list of tasks to perform, please see [challenge](docs/challenge.md).

Thank you! 🙏
