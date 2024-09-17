#!/bin/bash

# Prompt for plugin name
read -p "Enter plugin name (press Enter for default: example-elementor-react-addon): " PLUGIN_NAME
PLUGIN_NAME=${PLUGIN_NAME:-example-elementor-react-addon}

# Create main plugin directory
mkdir -p "$PLUGIN_NAME"

# Copy assets folder
cp -R assets "$PLUGIN_NAME/"

# Copy widgets folder
cp -R widgets "$PLUGIN_NAME/"

# Copy main PHP file
MAIN_PHP_FILE=$(ls *.php | grep -v index.php | head -n 1)
if [ -n "$MAIN_PHP_FILE" ]; then
    cp "$MAIN_PHP_FILE" "$PLUGIN_NAME/"
else
    echo "Warning: Main PHP file not found. Please copy it manually."
fi

# Create index.php file
echo "<?php //no permissions" > "$PLUGIN_NAME/index.php"

# Create docker-compose.yml file
cat << EOF > "$PLUGIN_NAME/docker-compose.yml"
version: '3'

services:
  db:
    image: mysql:5.7
    volumes:
      - db_data:/var/lib/mysql
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: somewordpress
      MYSQL_DATABASE: wordpress
      MYSQL_USER: wordpress
      MYSQL_PASSWORD: wordpress

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    volumes:
      - wordpress_data:/var/www/html:rw
      - ../$PLUGIN_NAME:/var/www/html/wp-content/plugins/$PLUGIN_NAME:ro
    ports:
      - '8000:80'
    restart: always
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: wordpress
      WORDPRESS_DB_PASSWORD: wordpress
      WORDPRESS_DB_NAME: wordpress
volumes:
  db_data: {}
  wordpress_data: {}
EOF

echo "Plugin structure created successfully in ./$PLUGIN_NAME"