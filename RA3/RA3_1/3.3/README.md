
📂 **Práctica 3.3.1: Bastionado (Hardening) de Servidor de Producción**

Descripción
-----------
El hardening o bastionado es el proceso de asegurar un sistema reduciendo su superficie de vulnerabilidad. En esta práctica aplicamos configuraciones restrictivas para "blindar" el servidor frente a técnicas de reconocimiento y ataques de sesión.

¿Qué hacemos?
-------------
- Eliminamos la fuga de información desactivando banners y mostrando solo lo imprescindible en la cabecera `Server`.
- Implementamos cabeceras de seguridad (X-Frame-Options, X-XSS-Protection, etc.) que instruyen al navegador a comportarse de forma segura.
- Bloqueamos métodos HTTP obsoletos o peligrosos (`TRACE`) y limitamos los métodos permitidos.

Seguridad
---------
- `ServerTokens Prod`: Oculta la versión de Apache para dificultar la búsqueda de exploits específicos.
- `X-Frame-Options`: Mitiga ataques de clickjacking.
- `TraceEnable Off`: Bloquea el método TRACE para prevenir Cross‑Site Tracing (XST).

Archivos clave
-------------
- **httpd-hardening.conf**: Archivo maestro con directivas de seguridad inyectadas (hardening).
- **Dockerfile**: Contiene pasos para aplicar las modificaciones (por ejemplo con `sed`) sobre la configuración global del sistema base.

Nota: en el directorio también existe `httpd-hardering.conf` (posible duplicado con error tipográfico). Usa `httpd-hardening.conf` como fuente principal; considera eliminar o renombrar `httpd-hardering.conf` para evitar confusiones.

📸 Resultado de la verificación
-----------------------------

![imagen Resultado](/RA3/RA3_1/imagenes/pract3.3.1.png)

🚀 Despliegue y uso
------------------

Construcción y ejecución:

```bash
# Construcción de la imagen
docker build -t educiber/pps10480035_3.3:3.3.1 .

# Ejecución del contenedor blindado
docker run -d --name srv_hardened -p 80:80 educiber/pps10480035_3.3:3.3.1
```

Pruebas rápidas:

```bash
# Comprobar ocultación de versión
curl -I http://localhost

# Test de denegación de métodos (Debe devolver 405 Method Not Allowed)
curl -v -X TRACE http://localhost
```


