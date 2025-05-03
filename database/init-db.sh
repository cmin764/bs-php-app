#!/bin/bash
set -e

# Function to wait for MySQL to be ready
wait_for_mysql() {
    echo "Waiting for MySQL to start..."
    while ! mysqladmin ping -h"$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" --silent; do
        sleep 1
    done
}

# Function to import SQL files
import_sql_files() {
    local db_dir="$1"
    echo "Importing SQL files from $db_dir..."

    # Find all .sql files and sort them numerically
    for sql_file in $(find "$db_dir" -name "*.sql" | sort -V); do
        echo "Importing $sql_file..."
        mysql -h"$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < "$sql_file"
    done
}

# Set default values if not provided
MYSQL_HOST=${MYSQL_HOST:-localhost}
MYSQL_USER=${MYSQL_USER:-bs}
MYSQL_PASSWORD=${MYSQL_PASSWORD:-better-password}
MYSQL_DATABASE=${MYSQL_DATABASE:-usphere}
MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}

# Set root password argument if provided
if [ -n "$MYSQL_ROOT_PASSWORD" ]; then
    ROOT_PASS_ARG="-p$MYSQL_ROOT_PASSWORD"
else
    ROOT_PASS_ARG=""
fi

# Determine the database directory path
if [ -d "/database" ]; then
    # Running inside Docker
    DB_DIR="/database"
else
    # Running outside Docker
    DB_DIR="$(dirname "$0")"
fi

# Create the database if it doesn't exist
echo "Creating database if not exists..."
mysql -h"$MYSQL_HOST" -u"root" $ROOT_PASS_ARG -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"

# Create a user and grant privileges (only if not root)
if [ "$MYSQL_USER" != "root" ]; then
    echo "Creating user and granting privileges..."
    mysql -h"$MYSQL_HOST" -u"root" $ROOT_PASS_ARG -e "CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';"
    mysql -h"$MYSQL_HOST" -u"root" $ROOT_PASS_ARG -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';"
    mysql -h"$MYSQL_HOST" -u"root" $ROOT_PASS_ARG -e "FLUSH PRIVILEGES;"
fi

# Wait for MySQL if running in Docker
if [ -d "/docker-entrypoint-initdb.d" ]; then
    wait_for_mysql
fi

# Import all SQL files
import_sql_files "$DB_DIR"

echo "Database initialization completed successfully!"
