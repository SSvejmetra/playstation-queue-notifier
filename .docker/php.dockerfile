FROM phpswoole/swoole:php8.1-alpine

WORKDIR /app

RUN apk update
# RUN set -ex && apk --no-cache add postgresql-dev

# Install extensions
RUN docker-php-ext-install pdo pdo_mysql

# Install npm
RUN apk add --update npm

# Install chokidar
RUN npm install --save-dev chokidar

EXPOSE 80

CMD ["octane:start", "--watch", "--host=0.0.0.0", "--port=80"]

ENTRYPOINT [ "php", "artisan" ]