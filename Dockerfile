FROM php:8.2-apache-bullseye AS builder

# Proper labels instead of deprecated MAINTAINER
LABEL maintainer="Maksym Prokopov<mprokopov@gmail.com>" \
      org.opencontainers.image.description="BlogEngine application" \
      org.opencontainers.image.version="4134"

# Group ENV variables
ENV VERSION=4134 \
    DIST=e2_distr_v4134.zip \
    URL=https://blogengine.ru/download/e2_distr_v4134.zip

# Install dependencies and clean up in a single layer
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libpng-dev \
    libzip-dev \
    zlib1g-dev \
    libjpeg-dev \
    libmcrypt-dev \
    unzip \
    git && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd && \
    docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql zip && \
    curl --insecure -O $URL && \
    unzip -o $DIST -d /var/www/html && \
    rm $DIST && \
    chown -R www-data:www-data /var/www/html && \
    a2enmod rewrite

# Copy configuration files
COPY override_database_settings.php /var/www/html/
COPY entrypoint.sh /usr/local/bin/

# Set proper permissions for entrypoint
RUN chmod +x /usr/local/bin/entrypoint.sh

# Add security measures
RUN set -ex && \
    mkdir -p /var/www/html/tmp && \
    chown www-data:www-data /var/www/html/tmp && \
    chmod 755 /var/www/html/tmp && \
    echo "ServerTokens Prod" >> /etc/apache2/apache2.conf && \
    echo "ServerSignature Off" >> /etc/apache2/apache2.conf

# Use non-root user
USER www-data

# Add healthcheck
HEALTHCHECK --interval=30s --timeout=3s --start-period=30s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]