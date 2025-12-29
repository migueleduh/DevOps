
FROM php:8.2-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN rm -Rf /var/www/html/

ENV TZ=America_Sao_Paulo

COPY ./  /var/www/html/
