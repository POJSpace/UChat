FROM nginx:1.25-alpine

# Copy configuration
COPY nginx.conf /etc/nginx/nginx.conf

# Generate our public directory
RUN mkdir -p /srv
WORKDIR /srv

# Copy files
COPY base.html main.html
COPY base.html tech.html
COPY base.html food.html
COPY base.html meme.html
COPY base.html misc.html
COPY create.html .
COPY index.html .

# Open our configured port for HTTP
EXPOSE 80

# Install some admin utils
# TODO
