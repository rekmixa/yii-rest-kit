FROM yiisoftware/yii2-php:7.4-fpm

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/api/web|g' /etc/apache2/sites-available/000-default.conf