#!/bin/bash
set -e

# Instalirajte mysqli ekstenziju
docker-php-ext-install mysqli

# Pokrenite Apache server
apache2-foreground
