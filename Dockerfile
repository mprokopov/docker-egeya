FROM php:8.2-apache
MAINTAINER Maksym Prokopov<mprokopov@gmail.com>

RUN apt-get update && apt-get install -y libpng-dev libzip-dev zlib1g-dev libjpeg-dev libmcrypt-dev unzip git  \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd \
    && docker-php-ext-install gd mysqli pdo_mysql zip

ENV VERSION 4134
ENV DIST e2_distr_v${VERSION}.zip
ENV URL https://blogengine.ru/download/${DIST}

RUN curl --insecure -O $URL && unzip -o $DIST -d /var/www/html

COPY override_database_settings.php .
COPY entrypoint.sh /usr/local/bin

RUN chown -R www-data:www-data /var/www/html
RUN a2enmod rewrite

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]

EXPOSE 80
