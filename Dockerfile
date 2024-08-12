# ベースイメージを指定
FROM php:8.3.1-fpm

# システムの依存関係をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    libonig-dev \
    libxml2-dev \
    && rm -rf /var/lib/apt/lists/*

# PHPの拡張機能をインストール
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションのソースコードをコンテナにコピー
COPY . .

# Composerで依存関係をインストール
RUN composer install --no-dev --optimize-autoloader

# Laravelのキャッシュを生成
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# 必要に応じて、ストレージやキャッシュディレクトリの権限を設定
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# コンテナのポート設定（HTTPポートを開放）
EXPOSE 80

# コンテナ起動時に実行されるコマンドを指定
CMD ["php-fpm"]
