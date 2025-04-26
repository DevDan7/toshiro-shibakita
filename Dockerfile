FROM php:8.2-fpm

# Instalar Nginx y extensiones PHP necesarias
RUN apt-get update && apt-get install -y nginx \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Copiar archivos de configuración
COPY nginx.conf /etc/nginx/nginx.conf
COPY index.php /var/www/html/

# Exponer puertos
EXPOSE 80

# Comando para iniciar PHP-FPM y Nginx
CMD ["sh", "-c", "php-fpm & nginx -g 'daemon off;'"]

