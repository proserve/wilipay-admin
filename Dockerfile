FROM proserve/nginx-php-fpm-laravel:0.1.0

ADD deployment/nginx-site.conf /etc/nginx/sites-available/default.conf
ADD deployment/nginx-site-ssl.conf /etc/nginx/sites-available/default-ssl.conf
RUN rm -Rf /etc/nginx/nginx.conf
ADD deployment/nginx.conf /etc/nginx/nginx.conf

RUN apk add --update --no-cache \
    xvfb libgcc libstdc++ libx11 glib libxrender libxext libintl \
    libcrypto1.0 libssl1.0 \
ttf-dejavu ttf-droid ttf-freefont ttf-liberation ttf-ubuntu-font-family dbus

RUN apk add --update-cache \
            --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing/ \
            --allow-untrusted wkhtmltopdf

RUN  chmod +x /usr/bin/wkhtmltopdf

ADD deployment/xvfb-run /usr/bin/xvfb-run
RUN  chmod +x /usr/bin/xvfb-run

COPY . /var/www/html/
WORKDIR /var/www/html/
RUN touch storage/logs/laravel.log
RUN chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache



# php artisan view:clear
# php artisan route:clear
# php artisan config:clear
# php artisan config:cache
# php artisan cache:clear

RUN rm -rf /var/cache/apk/*

EXPOSE 80