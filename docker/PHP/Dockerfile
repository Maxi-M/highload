FROM php:7.4-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
curl \
wget \
git \
unzip \
libfreetype6-dev \
libjpeg62-turbo-dev \
libxslt-dev \
libicu-dev \
libmcrypt-dev \
libpng-dev \
libxml2-dev \
libonig-dev \
libzip-dev \
libmemcached-dev \


&& docker-php-ext-install -j$(nproc) iconv mbstring mysqli pdo_mysql zip \
&& docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd \
&& pecl install xdebug mcrypt-1.0.2\
&& pecl install memcached-3.1.5\
&& pecl install redis-5.2.2\
&& docker-php-ext-enable xdebug memcached redis

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl
RUN docker-php-ext-install xsl
RUN docker-php-ext-install soap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
ADD ./xdebug.ini /etc/php/7.4/mods-available/xdebug.ini

RUN usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data

WORKDIR /var/www/web

USER "${USER_ID}:${GROUP_ID}"

CMD ["php-fpm"]