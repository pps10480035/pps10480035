FROM owasp/modsecurity-crs:nginx
USER root

RUN apt-get update && apt-get install -y php-fpm apache2-utils && rm -rf /var/lib/apt/lists/*

# BUSCAR Y ACTIVAR EL BLOQUEO (No importa la ruta)
RUN find /etc -name "modsecurity.conf" -exec sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/' {} +

# Configuración de PHP puerto 9000
RUN sed -i 's|listen = /run/php/php8.2-fpm.sock|listen = 127.0.0.1:9000|' /etc/php/8.2/fpm/pool.d/www.conf

RUN htpasswd -bc /etc/nginx/.htpasswd edu edu123
RUN mkdir -p /etc/nginx/ssl /var/www/html/protegido
COPY server.crt /etc/nginx/ssl/
COPY server.key /etc/nginx/ssl/
COPY nginx.conf /etc/nginx/conf.d/default.conf
COPY index.php /var/www/html/

# Script de inicio mejorado
RUN echo '#!/bin/bash\nservice php8.2-fpm start\n/docker-entrypoint.sh nginx -g "daemon off;"' > /start.sh && chmod +x /start.sh

EXPOSE 80 443
CMD ["/start.sh"]
