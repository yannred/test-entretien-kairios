FROM php:7.4-apache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && echo "LISTEN 8080" >> /etc/apache2/ports.conf \
    && curl -sL https://deb.nodesource.com/setup_18.x  | bash - \
    && apt-get update \
    && apt-get install -y nodejs \
    && npm install -g yarn

COPY . /var/www/html
COPY ./docker/entrypoint.sh /usr/bin/entrypoint.sh
COPY ./docker/apache2/hosts.conf /etc/apache2/sites-enabled/hosts.conf
COPY ./docker/apache2/symfony.conf /etc/apache2/sites-available/000-default.conf

RUN chown -R www-data:www-data /var/www \
    && echo "date.timezone = Europe/Paris" >> /usr/local/etc/php/php.ini \
    && usermod -u 1000 www-data
    
RUN ["chmod", "+x", "/usr/bin/entrypoint.sh"]

HEALTHCHECK --interval=5s --timeout=3s CMD curl --fail http://localhost:80/ || exit 1

WORKDIR /var/www/html

RUN set -eux; \
	composer install; \
	composer dump-autoload; \
    chmod +x bin/console; sync

USER www-data

ENTRYPOINT ["/usr/bin/entrypoint.sh"]