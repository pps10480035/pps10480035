
📂 **Práctica 3.2.1: Implementación de Cifrado SSL/TLS y HTTPS Forzado**

Descripción
-----------
Esta práctica se enfoca en garantizar la tríada de la seguridad (Confidencialidad, Integridad y Disponibilidad) mediante el uso de protocolos de cifrado de capa de transporte. Transformamos un servidor inseguro en un entorno de confianza.

¿Qué hacemos?
-------------
- Generamos una infraestructura de clave pública (PKI) local creando certificados digitales.
- Configuramos Apache para que escuche en el puerto 443 y configuramos la ruta a los certificados.
- Establecemos una redirección permanente (301) desde HTTP a HTTPS para forzar el uso de TLS.

Seguridad
---------
Protección contra ataques Man‑in‑the‑Middle (MitM). Al cifrar la comunicación, cualquier interceptación de tráfico por un tercero resultará en datos ilegibles.

Archivos clave
-------------
- **server.crt** / **server.key**: El certificado digital y su clave privada asociada (si existen en el proyecto, o se generan en el build).
- **000-default.conf**: Configuración del `VirtualHost` en el puerto 80 con directivas de redirección hacia HTTPS.
- **default-ssl.conf**: Configuración del `VirtualHost` seguro con la ruta a los certificados y activación del motor SSL.
- **Dockerfile**: Contiene pasos de build; puede incluir la generación automática de certificados y la activación del módulo `ssl`.

📸 Resultado de la verificación
-----------------------------

![imagen Resultado](/RA3/RA3_1/imagenes/pract3.2.png)

🚀 Despliegue y uso
------------------

Construye la imagen y ejecuta el contenedor (mapear ambos puertos es vital):

```bash
# Construcción de la imagen
docker build -t educiber/pps10480035_3.2:3.2.1 .

# Ejecución del contenedor (Es vital mapear ambos puertos)
docker run -d --name srv_ssl -p 80:80 -p 443:443 educiber/pps10480035_3.2:3.2.1

# Verificación de certificados
openssl s_client -connect localhost:443
```

