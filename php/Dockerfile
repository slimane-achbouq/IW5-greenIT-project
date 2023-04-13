FROM php:8.0-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip wget \
        libicu-dev \
        libmemcached11 \
        libmemcachedutil2 \
        libmemcached-dev \
        libmcrypt-dev \
        libpng-dev \
        libfreetype6-dev \
        libjpeg-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
	&& docker-php-ext-install gd \
    && docker-php-ext-install intl bcmath pcntl opcache pdo pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/symfony_docker

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g yarn

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email "slimane321@gmail.com" && git config --global user.name "Slimane Achbouq"