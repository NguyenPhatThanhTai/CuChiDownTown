#!/bin/sh

set -e

host="$WORDPRESS_DB_HOST"
user="$WORDPRESS_DB_USER"
password="$WORDPRESS_DB_PASSWORD"

echo "Database host: $host"
echo "⏳ Waiting for MariaDB to be ready at $host..."

while ! mysqladmin ping -h"${host%%:*}" --silent; do
  sleep 1
done

echo "✅ MariaDB is ready!"

exec docker-entrypoint.sh apache2-foreground
