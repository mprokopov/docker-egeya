FROM php:5.6-apache
MAINTAINER kev<noreply@datageek.info>

RUN a2enmod rewrite actions

RUN apt-get update && apt-get install -y libpng12-dev libjpeg-dev libmcrypt-dev unzip git \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
    && docker-php-ext-install gd mcrypt mbstring mysql zip

ADD e2_distr_v2858/ /var/www/html
