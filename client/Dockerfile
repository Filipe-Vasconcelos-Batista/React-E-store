FROM phpstorm/php-apache:8.2-xdebug3.2
RUN docker-php-ext-install pdo pdo_mysql


COPY . /var/www/html

# Set the document root to the public directory
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's|<Directory /var/www/html/>|<Directory /var/www/html/public/>|g' /etc/apache2/apache2.conf
# Ensure correct permissions
# Enable Apache mod_rewrite \
RUN a2enmod rewrite