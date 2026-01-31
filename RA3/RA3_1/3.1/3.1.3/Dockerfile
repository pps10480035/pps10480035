FROM httpd:2.4

# 1. Instalar ModSecurity y dependencias
RUN apt-get update && apt-get install -y libapache2-mod-security2 && rm -rf /var/lib/apt/lists/*
RUN cp /usr/lib/apache2/modules/mod_security2.so /usr/local/apache2/modules/

# 2. Activar módulos necesarios (SSL, Headers, Unique_id para OWASP, Security)
RUN sed -i 's/#LoadModule ssl_module/LoadModule ssl_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule headers_module/LoadModule headers_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule socache_shmcb_module/LoadModule socache_shmcb_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule unique_id_module/LoadModule unique_id_module/' /usr/local/apache2/conf/httpd.conf
RUN echo "LoadModule security2_module modules/mod_security2.so" >> /usr/local/apache2/conf/httpd.conf

# 3. Copiar TODA la estructura de OWASP al contenedor
COPY owasp-crs /usr/local/apache2/conf/owasp-crs

# 4. Copiar tus archivos previos (SSL, Hardening, etc.)
COPY server.crt /usr/local/apache2/conf/server.crt
COPY server.key /usr/local/apache2/conf/server.key
COPY default-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf
COPY hardened.conf /usr/local/apache2/conf/extra/hardened.conf
COPY modsecurity.conf /usr/local/apache2/conf/extra/modsecurity.conf

# 5. Configuración de carga incremental
RUN echo "Include conf/extra/httpd-ssl.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/hardened.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/modsecurity.conf" >> /usr/local/apache2/conf/httpd.conf && \
    # CARGA DE REGLAS OWASP (Orden crítico: setup primero, luego reglas)
    echo "Include conf/owasp-crs/crs-setup.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "IncludeOptional conf/owasp-crs/rules/*.conf" >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80
EXPOSE 443
