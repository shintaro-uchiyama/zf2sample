FROM php:5.6.27-apache

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    libicu-dev \
    wget \
    vim \
    locales && \
    rm -r /var/lib/apt/lists/* && \
    echo "ja_JP.UTF-8 UTF-8" >> /etc/locale.gen && \
    locale-gen ja_JP.UTF-8
ENV LC_ALL ja_JP.UTF-8

RUN a2enmod rewrite
# Composerのインストール
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# PHP Unitをインストール
RUN wget https://phar.phpunit.de/phpunit.phar && \
    chmod +x phpunit.phar && \
    mv phpunit.phar /usr/local/bin/phpunit

# PHPの拡張モジュールをインストール
RUN docker-php-ext-install mbstring mysql pdo_mysql intl

