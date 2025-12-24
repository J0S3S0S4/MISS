FROM richarvey/nginx-php-fpm:latest

COPY . .

# Configuración de Laravel
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Permisos para Laravel
RUN chmod -R 775 storage bootstrap/cache

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# ESTA ES LA LÍNEA NUEVA: Ejecutar migraciones al iniciar
CMD ["sh", "-c", "php artisan migrate --force && /start.sh"]
