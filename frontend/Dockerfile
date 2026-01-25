FROM debian:latest
LABEL maintainer="pabmarnav6@alu.edu.gva.es"
RUN apt-get update && apt-get install -y apache2 && apt-get clean && rm -rf /var/lib/apt/lists/*
RUN a2enmod rewrite
# Copiar todo y limpiar basura inicial
RUN rm -rf /var/www/html/*
COPY conf/vhosts/production.conf /etc/apache2/sites-enabled/000-default.conf
COPY app/public_html /var/www/html
COPY config/urls.prod.js /var/www/html/config/urls.js
# Permisos y Debug
RUN chown -R www-data:www-data /var/www/html \
    && echo "DEPLOYMENT SUCCESS" > /var/www/html/status.txt
EXPOSE 80
# Runtime script
CMD ["/bin/bash", "-c", "rm -f /var/www/html/index.html && sed -i \"s|__BACKEND_URL__|$BACKEND_URL|g\" /var/www/html/config/urls.js && apachectl -D FOREGROUND"]
