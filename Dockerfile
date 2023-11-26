FROM nginx:1.25-alpine

# Install dependencies
RUN apk update
RUN apk add fcgi php81 php-fpm php81-sqlite3 sqlite

# enable FastCGI autostart
RUN echo 'php-fpm81' > /docker-entrypoint.d/fastcgi.sh
RUN chmod +x /docker-entrypoint.d/fastcgi.sh

# Copy our files
WORKDIR /srv
COPY . .

# Set correct permissions
RUN chown -R nginx .
RUN chmod -R 777 .

# Use our nginx config file
COPY nginx.conf /etc/nginx/nginx.conf

# open port 8000
EXPOSE 8000
