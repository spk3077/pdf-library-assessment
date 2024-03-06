# File: Dockerfile
# Assignment: MS Capstone
# Lanuguage: DSL
# Author: Sean Kells <spk3077@rit.edu>
# Description: Builds PHP Container to include ext-gd
FROM php:8.2-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd