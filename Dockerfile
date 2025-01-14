# Utiliser une image de base PHP avec Apache
FROM php:8.1-apache

# Installer les extensions nécessaires pour Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure-gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Activer les modules Apache nécessaires
RUN a2enmod rewrite

# Copier les fichiers du projet Laravel dans le conteneur
COPY . /var/www/html/

# Définir le répertoire de travail
WORKDIR /var/www/html

# Installer Composer pour la gestion des dépendances PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances Laravel avec Composer
RUN composer install --no-dev --optimize-autoloader

# Exposer le port 80 pour l'accès à l'application
EXPOSE 80

# Lancer Apache en mode premier plan
CMD ["apache2-foreground"]
