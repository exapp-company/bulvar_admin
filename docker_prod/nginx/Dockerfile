FROM nginx:stable-alpine

COPY ./docker_prod/nginx/default.conf /etc/nginx/conf.d/default.conf
RUN touch /var/run/nginx.pid \
    && chown -R nginx:nginx /var/run/nginx.pid \
    && chown -R nginx:nginx /var/cache/nginx