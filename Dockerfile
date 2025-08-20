FROM php:8.2-fpm

ENV DEBIAN_FRONTEND=noninteractive

# Dependencias de PHP y sistema
RUN apt-get update && apt-get install -y \
    libpq-dev git unzip zip curl libicu-dev libonig-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_pgsql intl opcache \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
    && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN useradd -m symfony
USER symfony

WORKDIR /var/www/html

# Copiar proyecto
COPY --chown=symfony:symfony . .

# Instalar dependencias PHP
RUN composer install --no-interaction --optimize-autoloader --no-scripts

# Instalar dependencias JS y compilar assets
RUN npm install
RUN npm run build

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
