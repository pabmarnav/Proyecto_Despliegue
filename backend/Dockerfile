FROM debian:latest
LABEL maintainer="pabmarnav6@alu.edu.gva.es"
RUN apt-get update && apt-get install -y apache2 php php-cli php-yaml php-mysql libapache2-mod-php && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite headers
RUN rm -rf /var/www/html/*
COPY conf/vhosts/production.conf /etc/apache2/sites-enabled/000-default.conf
COPY app /var/www/html
RUN chown -R www-data:www-data /var/www/html && echo "DEPLOYMENT SUCCESS" > /var/www/html/status.txt
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
