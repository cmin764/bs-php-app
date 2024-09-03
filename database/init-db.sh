#!/bin/bash
set -e

# Wait for MySQL to start
echo "Waiting for MySQL to start..."
sleep 5  # not the best way to "poll" the server

# Create the database
echo "Creating database..."
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"

# Create a user and grant privileges
echo "Creating user and granting privileges..."
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "CREATE USER IF NOT EXISTS '$MYSQL_USER'@'%' IDENTIFIED BY '$MYSQL_PASSWORD';"
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'%';"
mysql -u root -p"$MYSQL_ROOT_PASSWORD" -e "FLUSH PRIVILEGES;"

# Import the SQL dump
dump="/docker-entrypoint-initdb.d/database/1-schema.sql"
if [ -f $dump ]; then
    echo "Importing SQL dump..."
    mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" $MYSQL_DATABASE < $dump
fi

# FIXME(cmin764): Iterate over all `*-migrate-*` files and import the dumps.
dump="/docker-entrypoint-initdb.d/database/2-migrate-phone.sql"
if [ -f $dump ]; then
    echo "Apply SQL phone migration..."
    mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" $MYSQL_DATABASE < $dump
fi
