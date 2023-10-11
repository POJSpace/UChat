FROM nginx:1.25-alpine

# Copy configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Copy base site files
RUN mkdir -p /srv
COPY site/* /srv

# Open our configured port
EXPOSE 80

# Install some admin utils

