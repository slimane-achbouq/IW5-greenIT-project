FROM php:8.0-fpm

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g yarn

RUN apt-get update && apt-get install -y vim wget libzip-dev libpq-dev memcached \
        libicu-dev \
        libmemcached11 \
        libmemcachedutil2 \
        libmemcached-dev \
        libmcrypt-dev \
        libpng-dev \
        libfreetype6-dev \
        libjpeg-dev \
    	&& docker-php-ext-configure gd --with-jpeg --with-freetype \
    	&& docker-php-ext-install gd

RUN docker-php-ext-install \
    bcmath \
    intl \
    pcntl \
    pdo \
    pdo_pgsql \
    pgsql \
    shmop \
    zip

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN ln -s /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pgsql/extension=pgsql/' /usr/local/etc/php/php.ini
RUN sed -i -e 's/;extension=pdo_pgsql/extension=pdo_pgsql/' /usr/local/etc/php/php.ini


RUN wget https://getcomposer.org/installer -O - | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

WORKDIR /var/www/app

EXPOSE 9000

CMD ["php-fpm", "-F", "-R"]