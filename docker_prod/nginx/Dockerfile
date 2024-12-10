FROM nginx:alpine

WORKDIR /var/www

RUN rm /etc/nginx/conf.d/default.conf

COPY docker_prod/nginx/default.conf /etc/nginx/conf.d/