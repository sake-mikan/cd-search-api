FROM php:8.2-cli

# 必要パッケージ
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install zip pdo pdo_pgsql

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# ソースコピー
COPY . .

# 権限
RUN chmod -R 777 storage bootstrap/cache

# Composer install
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

# 起動時コマンド
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000
