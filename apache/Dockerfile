FROM httpd:2.4-alpine

# Apache confog
COPY httpd.conf /usr/local/apache2/conf/httpd.conf

# app directory
RUN mkdir -p /var/www/html && \
    chown -R daemon:daemon /var/www/html

EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
  CMD httpd -t || exit 1