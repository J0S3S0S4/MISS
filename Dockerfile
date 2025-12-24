FROM richarvey/nginx-php-fpm:latest

COPY . .

# Configuración de Laravel
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Permisos
RUN chmod -R 775 storage bootstrap/cache
