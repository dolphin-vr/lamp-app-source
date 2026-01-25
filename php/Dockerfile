FROM php:8.3-fpm-alpine

# install MySQL extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Configure PHP-FPM for production
RUN { \
    echo '[www]'; \
    echo 'pm = dynamic'; \
    echo 'pm.max_children = 50'; \
    echo 'pm.start_servers = 5'; \
    echo 'pm.min_spare_servers = 5'; \
    echo 'pm.max_spare_servers = 35'; \
} > /usr/local/etc/php-fpm.d/zz-custom.conf

# Copy application code
COPY app/ /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD php-fpm -t || exit 1
