FROM debian:latest

LABEL maintainer="tu_email@ejemplo.com"

RUN apt-get update && apt-get install -y \
    apache2 \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
