FROM php:8.1-fpm

# Установка зависимостей
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libssl-dev \
        zlib1g-dev \
        curl \
        git \
        unzip \
        netcat-traditional \
        libxml2-dev \
        libpq-dev \
        libzip-dev \
        libicu-dev \
        libjpeg-dev \
        libpng-dev \
        libfreetype6-dev

# Конфигурация и установка расширений PHP
RUN docker-php-ext-install -j$(nproc) \
        gd \
        zip \
        opcache \
        intl \
        pdo_pgsql \
        pgsql \
        bcmath \
        sockets && \
    pecl install apcu && \
    pecl install redis && \
    docker-php-ext-enable apcu pdo_pgsql sodium 

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Удаление ненужных файлов
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

WORKDIR /var/www/

# Запуск команд
CMD composer i -o ; php bin/console doctrine:migrations:migrate ; php-fpm

# Открытие порта
EXPOSE 9000