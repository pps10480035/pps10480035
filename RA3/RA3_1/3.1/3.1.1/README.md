
📂 **Práctica 3.1.1: Despliegue de Infraestructura Web Base**

Descripción
-----------
Esta práctica constituye el pilar fundamental del proyecto. Se centra en la contenedorización de un servidor web Apache sobre una distribución Linux (Ubuntu), estableciendo las bases de un entorno aislado y reproducible.

¿Qué hacemos?
-------------
- Creamos un entorno estanco mediante Docker, eliminando la dependencia del sistema operativo anfitrión.
- Configuramos el servicio `apache2` para servir contenido estático.
- Limpiamos residuos de instalación para optimizar el peso de la imagen.
-- Establecemos un punto de entrada para contenido estático (configurable desde la imagen).

Seguridad
---------
Aplicamos el principio de Minimización de Servicios: instalamos únicamente lo necesario para servir HTTP y reducimos la superficie de ataque en la imagen final.

Archivos clave
-------------
- **Dockerfile**: Define la construcción por capas, optimizando la caché y el tamaño final de la imagen; automatiza la configuración del servidor.
- **default-ssl.conf**: Ejemplo de bloque de VirtualHost y configuración SSL incluida en la práctica.
- **hardened.conf**: Configuraciones de hardening aplicadas al servicio Apache.
- **server.crt** / **server.key**: Certificado y clave de ejemplo usados por `default-ssl.conf`.

📸 Resultado de la verificación
-----------------------------

![imagen Resultado](/RA3/RA3_1/imagenes/pract1.png)

🚀 Despliegue y uso
------------------

Construye la imagen y ejecuta el contenedor con los siguientes comandos:

```bash
# Construcción de la imagen
docker build -t educiber/pps10480035_3.1:3.1.1 .

# Ejecución del contenedor
docker run -d --name srv_base -p 8080:80 educiber/pps10480035_3.1:3.1.1

# Verificación de logs
docker logs -f srv_base
```

Notas finales
------------
- Accede a `http://localhost:8080` (o la IP del host) para verificar el servicio.
- Sustituye la captura en la sección de verificación por una imagen real al entregar la práctica.

Archivo
------
El README actualizado está en [RA3/RA3_1/3.1/3.1.1/README.md](RA3/RA3_1/3.1/3.1.1/README.md).
