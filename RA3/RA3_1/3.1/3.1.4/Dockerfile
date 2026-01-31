FROM httpd:2.4

# 1. Instalar módulos y dependencias
RUN apt-get update && apt-get install -y \
    libapache2-mod-security2 \
    libapache2-mod-evasive \
    && rm -rf /var/lib/apt/lists/*

# 2. Copiar los archivos binarios (.so)
RUN cp /usr/lib/apache2/modules/mod_security2.so /usr/local/apache2/modules/ && \
    cp /usr/lib/apache2/modules/mod_evasive.so /usr/local/apache2/modules/

# 3. Limpiar y preparar httpd.conf (ServerName y Módulos base)
RUN sed -i 's/#LoadModule ssl_module/LoadModule ssl_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule headers_module/LoadModule headers_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule socache_shmcb_module/LoadModule socache_shmcb_module/' /usr/local/apache2/conf/httpd.conf && \
    sed -i 's/#LoadModule unique_id_module/LoadModule unique_id_module/' /usr/local/apache2/conf/httpd.conf && \
    echo "ServerName localhost" >> /usr/local/apache2/conf/httpd.conf

# 4. CARGA PRIORITARIA DE MOD_EVASIVE
# Lo cargamos antes que nadie para que intercepte la IP antes del procesamiento de ModSecurity
RUN echo "LoadModule evasive_module modules/mod_evasive.so" >> /usr/local/apache2/conf/httpd.conf && \
    echo "LoadModule security2_module modules/mod_security2.so" >> /usr/local/apache2/conf/httpd.conf

# 5. Asegurar permisos en /tmp (donde dejaremos los logs de baneo ahora)
RUN chmod 1777 /tmp

# 6. Copiar tus archivos de configuración
COPY owasp-crs /usr/local/apache2/conf/owasp-crs
COPY server.crt /usr/local/apache2/conf/server.crt
COPY server.key /usr/local/apache2/conf/server.key
COPY default-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf
COPY hardened.conf /usr/local/apache2/conf/extra/hardened.conf
COPY modsecurity.conf /usr/local/apache2/conf/extra/modsecurity.conf
COPY evasive.conf /usr/local/apache2/conf/extra/evasive.conf
COPY post.php /usr/local/apache2/htdocs/post.php

# 7. Incluir configuraciones (Orden: Evasive -> Hardening -> WAF)
RUN echo "Include conf/extra/evasive.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/hardened.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/extra/modsecurity.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "Include conf/owasp-crs/crs-setup.conf" >> /usr/local/apache2/conf/httpd.conf && \
    echo "IncludeOptional conf/owasp-crs/rules/*.conf" >> /usr/local/apache2/conf/httpd.conf

EXPOSE 80
EXPOSE 443
