FROM php:7.4.3-cli

# Install services
RUN apt-get update \
  && apt-get install -y $PHPIZE_DEPS \
  && apt-get install -y --no-install-recommends git zip unzip

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www

# Install dependencies
RUN composer install

# Expose application port
EXPOSE 8080

# Start the php server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]
