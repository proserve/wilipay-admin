FROM proserve/nginx-php-fpm-laravel:0.1.0

ADD nginx-site.conf /etc/nginx/sites-available/default.conf
RUN rm -Rf /etc/nginx/nginx.conf
ADD nginx.conf /etc/nginx/nginx.conf

COPY . /var/www/html/
WORKDIR /var/www/html/
RUN touch storage/logs/laravel.log
RUN chmod -R 777 /var/www/html/storage \
    && chmod -R 777 /var/www/html/bootstrap/cache

RUN php artisan config:cache
RUN php artisan view:clear
RUN php artisan route:clear
RUN php artisan config:clear
RUN php artisan cache:clear

EXPOSE 80