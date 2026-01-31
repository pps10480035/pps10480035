FROM ubuntu:latest

# Instalamos Apache y OpenSSL
RUN apt-get update && apt-get install -y apache2 openssl && rm -rf /var/lib/apt/lists/*

# Paso 1: Activar el Módulo SSL
RUN a2enmod ssl && a2enmod rewrite

# Paso 2: Crear el Certificado SSL Auto-firmado (en un solo paso)
RUN mkdir -p /etc/apache2/ssl
RUN openssl req -x509 -nodes -days 365 \
    -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache.key \
    -out /etc/apache2/ssl/apache.crt \
    -subj "/C=ES/ST=Castellon/L=Castellon/O=Caminas/OU=Server/CN=www.midominioseguro.com"

# Paso 3: Configurar Apache para que use SSL
COPY default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# Paso 5: Activar el Host Virtual y desactivar el por defecto
RUN a2dissite 000-default.conf && a2ensite default-ssl.conf

EXPOSE 80 443

CMD ["apachectl", "-D", "FOREGROUND"]
