# Dockerfile

FROM wordpress:latest

# Install pdo_mysql extension
RUN docker-php-ext-install pdo pdo_mysql
