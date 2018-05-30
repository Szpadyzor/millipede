FROM phalconphp/php-fpm

MAINTAINER Maciej Trybuła <maciej.trybula@gmail.com>

# Install Git
RUN apt-get update && apt-get install -y git-core zip

WORKDIR /var/www/millipede

COPY composer.json ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN /usr/local/bin/composer install
