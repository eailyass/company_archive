FROM php:8.0.8-fpm

# Install dependencies I need
# RUN add-apt-repository ppa:libreoffice/ppa


RUN apt-get update 

RUN mkdir -p /usr/share/man/man1


RUN apt-get install -y zlib1g-dev libzip-dev libpq-dev git libicu-dev libxml2-dev unzip locales-all\
    && docker-php-ext-install intl \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip xml


RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# Set timezone
RUN rm /etc/localtime
RUN ln -s /usr/share/zoneinfo/Europe/France /etc/localtime
RUN "date"

# Set workdir
WORKDIR /var/www/company_archive

COPY docker-local/php/entrypoint.sh /usr/local/bin/entrypoint
RUN chmod +x /usr/local/bin/entrypoint

# Allow to choose skeleton
ARG SKELETON="symfony/skeleton"
ENV SKELETON ${SKELETON}

# Allow to use development versions of Symfony
ARG STABILITY="stable"
ENV STABILITY ${STABILITY}

# Allow to select skeleton version
ARG SYMFONY_VERSION="5.4"
ENV SYMFONY_VERSION ${SYMFONY_VERSION}

ENTRYPOINT ["entrypoint"]