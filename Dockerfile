FROM php:8.4-apache

RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        gd \
        intl \
        mbstring \
        mysqli \
        pdo_mysql \
        sockets \
        zip \
        opcache \
    && a2enmod rewrite headers \
    && rm -rf /var/lib/apt/lists/*

COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
RUN mkdir -p /var/www/html/uploads/backoffice/bank-transfers \
    && chown -R www-data:www-data /var/www/html/uploads

COPY docker/container-entrypoint.sh /usr/local/bin/tormorgroup-entrypoint
RUN chmod 755 /usr/local/bin/tormorgroup-entrypoint

ENTRYPOINT ["/usr/local/bin/tormorgroup-entrypoint"]
CMD ["apache2-foreground"]
