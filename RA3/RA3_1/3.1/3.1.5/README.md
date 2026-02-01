
📂 **Práctica 3.1.5: WAF con Nginx + ModSecurity (Defensa Activa)**

Descripción
-----------
Implementación de un cortafuegos de aplicación web (WAF) de grado industrial para la detección y bloqueo proactivo de ataques de Capa 7.

¿Qué hacemos?
-------------
- Desplegamos Nginx como proxy inverso junto con el motor ModSecurity v3.
- Integramos las reglas OWASP CRS (Core Rule Set) para identificar patrones maliciosos en tiempo real.
- Orquestamos la configuración del conector ModSecurity–Nginx y las reglas principales.

Seguridad
---------
Protección contra el Top 10 de OWASP, incluyendo SQL Injection, Cross‑Site Scripting (XSS) y Remote File Inclusion (RFI). ModSecurity opera en modo de detección y bloqueo según la política.

Archivos clave
-------------
- **nginx.conf**: Configuración del proxy inverso y carga del módulo ModSecurity.
- **Dockerfile**: Proceso de compilación del conector ModSecurity–Nginx y despliegue de la imagen.
- **index.php**: Punto de prueba dinámico usado para verificar detecciones (payloads, POSTs).
- **server.crt** / **server.key**: Certificado y clave para el entorno SSL de prueba.
- **(modsecurity.conf / main.conf)**: Si existen en la carpeta, contienen la configuración del motor y la orquestación de reglas OWASP; si no, están referenciadas desde la imagen.

🚀 Despliegue y uso
------------------

Ejecuta el contenedor (WAF activo):

```bash
# Ejecución del contenedor (WAF Activo)
docker run -d --name waf_active -p 80:80 educiber/pps10480035_3.1:3.1.5

# Prueba de ataque (será bloqueado si ModSecurity está activo)
curl "http://localhost/?id=<script>alert(1)</script>"
```

