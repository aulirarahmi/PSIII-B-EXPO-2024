# Menggunakan image resmi PHP dengan Apache
FROM php:8.1-apache

# Install ekstensi yang diperlukan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Salin file project ke dalam container
COPY . /var/www/html/

# Berikan izin untuk folder
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Aktifkan mod_rewrite untuk Apache
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80
