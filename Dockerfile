FROM composer:1.9 as vendor

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --prefer-dist \
    --ignore-platform-reqs \
    --no-dev \
    --no-suggest \
    --no-interaction \
    --no-plugins \
    --no-scripts

FROM php:7.3-alpine

WORKDIR /app

COPY bin/ bin/
COPY src/ src/

COPY --from=vendor /app/vendor/ vendor/

ENTRYPOINT [ "/app/bin/hash" ]