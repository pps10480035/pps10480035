FROM httpd:2.4

# 1. Instalar ModSecurity y todas sus dependencias de librerías
RUN apt-get update && apt-get install -y \
    libapache2-mod-security2 \
    && rm -rf /var/lib/apt/lists/*

# 2. LOCALIZAR Y COPIAR: Este es el paso crítico. 
# Buscamos el archivo .so donde lo instala apt y lo movemos a donde lo busca Apache
RUN cp /usr/lib/apache2/modules/mod_security2.so /usr/local/apache2/modules/

# 3. Activar módulos necesarios (v1 + v2)
RUN sed -i 's/#LoadModule ssl_module/LoadModule ssl_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule headers_module/LoadModule headers_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule socache_shmcb_module/LoadModule socache_shmcb_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule unique_id_module/LoadModule unique_id_module/' /usr/local/apache2/conf/httpd.conf

# 4. Cargar el módulo ModSecurity (Añadir al final de la lista de módulos)
RUN echo "LoadModule security2_module modules/mod_security2.so" >> /usr/local/apache2/conf/httpd.conf

# 5. Hardening previo (v1)
RUN sed -i 's/LoadModule autoindex_module/#LoadModule autoindex_module/' /usr/local/apache2/conf/httpd.conf && \
    echo "ServerTokens ProductOnly" >> /usr/local/apache2/conf/httpd.conf && \
    echo "ServerSignature Off" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Listen 443" >> /usr/local/apache2/conf/httpd.conf

# 6. Copiar configuraciones y certificados desde tu disco externo
COPY server.crt /usr/local/apache2/conf/server.crt
COPY server.key /usr/local/apache2/conf/server.key
COPY default-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf
COPY hardened.conf /usr/local/apache2/conf/extra/hardened.conf
COPY modsecurity.conf /usr/local/apache2/conf/extra/modsecurity.conf
COPY post.php /usr/local/apache2/htdocs/post.php

# 7. Incluir archivos en la configuración principal
RUN echo "Include conf/extra/httpd-ssl.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/hardened.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/modsecurity.conf" >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80
EXPOSE 443
