FROM php:7.2-fpm

RUN apt-get update

RUN apt-get install -y zlib1g-dev libpq-dev git libicu-dev libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install zip xml \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/Berlin /etc/localtime
RUN "date"

WORKDIR /var/www/millipede

COPY composer.json .
COPY app/symfony/.env .
RUN chmod a+rx composer.json

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN php -d memory_limit=-1 /usr/local/bin/composer install -o

RUN groupadd -g 1000 millipede \
 && useradd -g 1000 -u 1000 -d /home/millipede -s /bin/bash millipede

RUN mkdir /home/millipede && chown millipede:millipede /home/millipede && mkdir /sock && mkdir /var/log/php

COPY docker/php-fpm/conf/millipede.conf /usr/local/etc/php-fpm.d/

#ADD .composer /home/millipede/.composer

RUN chown -R millipede:millipede /usr/local/etc/php/conf.d /sock /var/www/millipede /var/log/php

RUN bin/console doctrine:schema:create