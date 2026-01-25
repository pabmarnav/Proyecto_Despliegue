FROM debian:latest

LABEL maintainer="pabmarnav6@alu.edu.gva.es"

RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-cli \
    php-yaml \
    php-mysql \
    libapache2-mod-php \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite headers

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
