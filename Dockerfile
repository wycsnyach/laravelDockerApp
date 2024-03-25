FROM php:8.2 as php

RUN apt-get update -y

#Linux Library
RUN apt-get install -y unzip \
    libpq-dev \
    libcurl4-gnutls-dev \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpng-dev \
    libjpeg62-turbo-dev

#PHP Extensions
RUN docker-php-ext-install pdo pdo_mysql bcmath gettext intl pdo_mysql gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

#Install Redis
RUN pecl install -o -f redis \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
ENTRYPOINT [ "docker/entrypoint.sh" ]

# ==============================================================================
#  node
FROM node:14-alpine as node

WORKDIR /var/www
COPY . .

RUN npm install --global cross-env
RUN npm install

VOLUME /var/www/node_modules