# 构建
FROM php:7.3-fpm
WORKDIR /application
RUN docker-php-ext-install pdo_mysql && \
sed -i 's#http://deb.debian.org#https://mirrors.163.com#g' /etc/apt/sources.list && \
apt-get update && \
apt-get install nginx -y
COPY ./ ./
RUN chmod -R 777 public && mkdir runtime && chmod -R 777 runtime 