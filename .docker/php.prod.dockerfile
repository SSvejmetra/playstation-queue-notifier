FROM phpswoole/swoole:php8.1-alpine

COPY . /app

WORKDIR /app

RUN apk update
RUN docker-php-ext-install pdo pdo_mysql

RUN apk add --update npm

RUN composer install
RUN npm install

EXPOSE 80

CMD ["octane:start", "--watch", "--host=0.0.0.0", "--port=80"]

ENTRYPOINT [ "php", "artisan" ]
