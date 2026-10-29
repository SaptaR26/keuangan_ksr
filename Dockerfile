FROM php:8.2-apache

# Instal ekstensi sistem yang dibutuhkan Laravel & SQLite
RUN apt-get update && apt-get install -y \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Aktifkan modul mod_rewrite Apache untuk Laravel routing
RUN a2enmod rewrite

# Salin kodingan composer bawaan
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur folder kerja utama di server
WORKDIR /var/www/html
COPY . .

# Jalankan instalasi dependensi Laravel secara otomatis
RUN composer install --no-dev --optimize-autoloader

# Atur hak akses folder penyimpanan database & cache agar tidak error
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Atur folder publik Apache agar mengarah ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# Port standar web server
EXPOSE 80
