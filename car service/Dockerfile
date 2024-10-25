FROM php:8.2

RUN apt-get update && apt-get install -y \
    git \
    libc6-dev \
    libsasl2-dev \
    libsasl2-modules \
    libssl-dev \
    zlib1g-dev \
    libzip-dev \
    libgmp-dev \  
    unzip  \
    && docker-php-ext-install pdo pdo_mysql sockets gmp
    


RUN curl -sS https://getcomposer.org/installer | php -- \
        --install-dir=/usr/local/bin --filename=composer

        
WORKDIR /app
COPY . .
RUN composer install


