FROM php:8.1-fpm

ARG user
ARG uid

# Install system dependencies
RUN apt-get clean && rm -rf /var/lib/apt/lists/*
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd
RUN useradd -u $uid -G www-data,root -d /home/$user  $user
RUN mkdir -p /home/$user
RUN chown -R $user /home/$user
# ALL ABOVE SHOULD BE CACHED

RUN mkdir -p /var/www
# COPY --chown=www-data:www-data . /var/www
RUN chown -R www-data:www-data /var/www
RUN chmod -R 774 /var/www

USER $user

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY --chown=www-data:www-data . /var/www
WORKDIR /var/www
RUN composer install

CMD /bin/sh init.sh