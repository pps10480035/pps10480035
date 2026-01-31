FROM httpd:2.4

# 1. Instalar dependencias necesarias para que Apache gestione SSL
RUN apt-get update && apt-get install -y openssl

# 2. Activar módulos: SSL y Headers
RUN sed -i 's/#LoadModule ssl_module/LoadModule ssl_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule headers_module/LoadModule headers_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule socache_shmcb_module/LoadModule socache_shmcb_module/' /usr/local/apache2/conf/httpd.conf

# 3. Hardening: Ocultar versión y desactivar autoindex
RUN sed -i 's/LoadModule autoindex_module/#LoadModule autoindex_module/' /usr/local/apache2/conf/httpd.conf && \
    echo "ServerTokens ProductOnly" >> /usr/local/apache2/conf/httpd.conf && \
    echo "ServerSignature Off" >> /usr/local/apache2/conf/httpd.conf

# 4. Forzar a Apache a escuchar en el 443
RUN echo "Listen 443" >> /usr/local/apache2/conf/httpd.conf

# 5. Copiar tus archivos (Asegúrate de que están en tu carpeta del disco externo)
COPY server.crt /usr/local/apache2/conf/server.crt
COPY server.key /usr/local/apache2/conf/server.key
COPY default-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf

# 6. Incluir la configuración SSL en el archivo principal
RUN echo "Include conf/extra/httpd-ssl.conf" >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80
EXPOSE 443
