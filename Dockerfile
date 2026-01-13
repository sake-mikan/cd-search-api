FROM php:8.2-cli

# 必要なパッケージ
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql

# Composer インストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリ
WORKDIR /var/www

# ソースコードコピー
COPY . .

# Laravel 用ディレクトリ権限
RUN chmod -R 777 storage bootstrap/cache

# Composer install
RUN composer install --no-dev --optimize-autoloader

# APP_KEY 生成
RUN php artisan key:generate

# ポート公開
EXPOSE 8000

# 起動コマンド
CMD php artisan serve --host=0.0.0.0 --port=8000
