FROM adalessa/php-laravel:8.0

WORKDIR /app
COPY composer.json .
COPY composer.lock .
RUN composer install --no-scripts
COPY . .
COPY entrypoint.sh entrypoint.sh
RUN chmod 777 -R storage

ENTRYPOINT ["./entrypoint.sh"]
