FROM nginx:1.25-alpine

# Install dependencies
RUN apk update
RUN apk add fcgi php81 php-fpm php81-sqlite3 openrc

# enable FastCGI autostart
RUN echo 'php-fpm81' > /docker-entrypoint.d/fastcgi.sh
RUN chmod +x /docker-entrypoint.d/fastcgi.sh

COPY . /srv
COPY nginx.conf /etc/nginx/nginx.conf

# open port 8000
EXPOSE 8000
