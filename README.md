# PHP Test Project

### Description

This is a very simple one-page application consisting of a single table and a form for creating new rows. To make it a little more complicated, we have written a 'framework' you have to use. Below is a set of simple tasks to perform. Please write a production-ready code.

### Installation

1. Create a private GitHub repository and invite @jurajmasar and @gyfis as collaborators
2. Create a new MySQL database
3. Rename `config/database` to `config/database.php` and configure your database connection settings in this file
4. Import `database/1-schema.sql` into your database
5. Apply any other existing migration in order (e.g.: `2-migrate-phone.sql`)

#### MySQL initialization

Login with the initial credentials of your *root* user and execute the following:

`mysql -u root -p` -> enter password

```SQL
CREATE DATABASE bs_php_app;
CREATE USER 'bs'@'localhost' IDENTIFIED BY 'better-password';
GRANT ALL PRIVILEGES ON bs_php_app.* TO 'bs'@'localhost';
```

Then you can import SQL dumps:

```console
mysql -u bs -p'better-password' bs_php_app < database/1-schema.sql
```

### Run server

Directly with PHP:

```console
php -S localhost:8000
```

Or through Docker Compose:

```console
docker-compose up
```

Rebuild the images with `docker-compose up --build` after bringing the services down including volumes removal with `docker-compose down -v`.

### Deploy to Heroku

1. Ensure initially that you have the ClearDB add-on (Heroku's MySQL) available and integrated. (easy to do it from the UI)
2. Create a new app, let's say `bs-php-app`.
3. Push code and release the `web` service. (this will build and upload images)
4. Ensure proper configuration via environment variables. (to access the DB)

```console
# Login and create your first app
heroku login
heroku create bs-php-app

# Tell Heroku to do a Docker-based deployment
heroku container:login
heroku stack:set container -a bs-php-app
heroku labs:enable --app=bs-php-app runtime-new-layer-extract  # fixes Apache
heroku container:push web --app bs-php-app
heroku container:release web --app bs-php-app

# Configures remote DB access via env vars credentials
heroku config:set MYSQL_USER=b********d4c --app bs-php-app
heroku config:set MYSQL_PASSWORD=c7******5 --app bs-php-app
heroku config:set MYSQL_HOST=us-cluster-east-01.k8s.cleardb.net --app bs-php-app
heroku config:set MYSQL_DATABASE=heroku_1f6******4f5 --app bs-php-app
```

> Make sure to manually import the SQL dumps in the remote DB. (not automated)

### Tasks to perform

1. Style the page using [Bootstrap](http://getbootstrap.com/) or [Tailwind](http://tailwind.com/)
  * Every other table row should be highlighted.
  * Use Bootstrap’s form-horizontal or equivalent to style the form.
  * Please make any other styling changes based on your preferences to make the interface look presentable.
2. Add a validation of new records.
3. Create a JS functionality to filter rows by city.
4. Implement submission of the form using AJAX.
5. Add a phone number column to the table.
6. Please deploy the project to any freehosting and send us the production link.

Thank you! 🙏
