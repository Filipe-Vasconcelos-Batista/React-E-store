FROM phpstorm/php-apache:8.2-xdebug3.2
RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y default-mysql-client

WORKDIR /var/www/html/server

COPY . .

# Set the document root to the public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/server/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|<Directory /var/www/html/>|<Directory /var/www/html/server/public/>|g' /etc/apache2/apache2.conf
# Ensure correct permissions
# Enable Apache mod_rewrite \
RUN a2enmod rewrite

RUN composer install

EXPOSE 80
CMD ["sh", "-c", "./config/waitForIt.sh database:3306 -- ./vendor/bin/doctrine-migrations migrate --no-interaction && apache2-foreground"]

