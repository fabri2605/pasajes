FROM php:8.1.2-fpm

# Copiamos los archivos package.json composer.json y composer-lock.json a /var/www/
COPY composer*.json /var/www/

# Nos movemos a /var/www/
WORKDIR /var/www/

ARG user
ARG uid

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    build-essential \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git \
    curl
# Download oracle packages and install OCI8
RUN mkdir /usr/lib/oracle
RUN mkdir /usr/lib/oracle/21.8
RUN mkdir /usr/lib/oracle/21.8/client64
RUN curl -o instantclient-basic-linux.x64-21.8.0.0.0dbru.zip https://download.oracle.com/otn_software/linux/instantclient/218000/instantclient-basic-linux.x64-21.8.0.0.0dbru.zip \
    && unzip instantclient-basic-linux.x64-21.8.0.0.0dbru.zip -d /usr/lib/oracle/21.8/client64 \
    && rm instantclient-basic-linux.x64-21.8.0.0.0dbru.zip \
    && curl -o instantclient-sdk-linux.x64-21.8.0.0.0dbru.zip https://download.oracle.com/otn_software/linux/instantclient/218000/instantclient-sdk-linux.x64-21.8.0.0.0dbru.zip \
    && unzip instantclient-sdk-linux.x64-21.8.0.0.0dbru.zip -d /usr/lib/oracle/21.8/client64 \
    && rm instantclient-sdk-linux.x64-21.8.0.0.0dbru.zip \
    && cd /usr/lib/oracle/21.8/client64 \
    && mv instantclient_21_8 lib \
    && cd /usr/lib/oracle/21.8/client64/lib \
    #&& ln -s libclntsh.so.21.8 libclntsh.so \
    #&& ln -s libocci.so.21.8 libocci.so \
    && echo /usr/lib/oracle/21.8/client64/lib > /etc/ld.so.conf.d/oracle.conf \
    && ldconfig
    ENV LD_LIBRARY_PATH /usr/lib/oracle/21.8/client64/lib/instantclient_21_8
    RUN apt-get -y install build-essential libaio1 \
    #php-dev php-pear
    && pecl channel-update pecl.php.net
    RUN docker-php-ext-install zip bcmath opcache pcntl  \
    && docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/lib/oracle/21.8/client64/lib \
    && pecl install oci8-3.2.1
#ENV LD_LIBRARY_PATH /usr/lib/oracle/21.8/client64/lib
# Install PHP extensions: Laravel needs also zip, mysqli and bcmath which
# are not included in default image. Also install our compiled oci8 extensions.

#RUN docker-php-ext-configure oci8 --with-oci8=instantclient,/usr/lib/oracle/21.8/client64/lib
#RUN docker-php-ext-install -j$(nproc) oci8
    # Install the PHP gd library
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Instalamos extensiones de PHP
RUN docker-php-ext-install pdo_mysql exif
#RUN docker-php-ext-configure gd --with-freetype --with-jpeg
#RUN docker-php-ext-install gd

# Instalamos composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

COPY --chown=www-data:www-data . /var/www
COPY . /var/www/
RUN chmod +x /home

RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Copiamos todos los archivos de la carpeta actual de nuestra
# computadora (los archivos de laravel) a /var/www/

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
# Instalamos dependendencias de composer
RUN composer install --no-ansi --no-dev --no-interaction --no-progress --optimize-autoloader --no-scripts
RUN composer update

# Corremos el comando php-fpm para ejecutar PHP

USER $user
