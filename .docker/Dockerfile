FROM php:8.2-cli-bookworm AS build

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions xdebug @composer-2