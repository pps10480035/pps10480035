FROM ubuntu:latest

RUN apt-get update && apt-get install -y apache2 && rm -rf /var/lib/apt/lists/*

# Activar módulos
RUN a2enmod headers rewrite

# ESTA LÍNEA es la clave: sobrescribir la config por defecto de seguridad de Ubuntu
RUN sed -i 's/ServerTokens OS/ServerTokens Prod/' /etc/apache2/conf-enabled/security.conf && \
    sed -i 's/ServerSignature On/ServerSignature Off/' /etc/apache2/conf-enabled/security.conf

COPY httpd-hardening.conf /etc/apache2/conf-available/hardening.conf
RUN a2enconf hardening

EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
