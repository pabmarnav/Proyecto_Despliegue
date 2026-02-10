FROM debian:latest

LABEL maintainer="pabmarnav6@alu.edu.gva.es"

RUN apt-get update && apt-get install -y \
    apache2 \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN rm -rf /var/www/html/*
COPY app /var/www/html/

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
