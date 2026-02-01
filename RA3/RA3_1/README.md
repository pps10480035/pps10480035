````markdown

📚 **RA3_1 — Prácticas de Despliegue y Seguridad Web**

## 📝 Descripción general
Colección de prácticas enfocadas en la contenedorización de servidores web (Apache/Nginx), configuración de hosting y hardening/mitigación de amenazas usando Docker para entornos reproducibles.

## 🔎 Índice de prácticas

- **Práctica 3.1.1: Despliegue de Infraestructura Web Base**
 [3.1/3.1.1/README.md](3.1/3.1.1/README.md)
- **Práctica 2: Integración de WAF con ModSecurity en Apache**
 [3.1/3.1.2/README.md](3.1/3.1.2/README.md)
- **Práctica 3: Implementación de Reglas OWASP CRS en ModSecurity**
 [3.1/3.1.3/README.md](3.1/3.1.3/README.md)
- **Práctica 4: Mitigación de Ataques DoS con mod_evasive**
 [3.1/3.1.4/README.md](3.1/3.1.4/README.md)
- **Práctica 3.1.5: WAF con Nginx + ModSecurity (Defensa Activa)**
 [3.1/3.1.5/README.md](3.1/3.1.5/README.md)
- **Práctica 3.2.1: Implementación de Cifrado SSL/TLS y HTTPS Forzado**
 [3.2/README.md](3.2/README.md)
- **Práctica 3.3.1: Bastionado (Hardening) de Servidor de Producción**
 [3.3/README.md](3.3/README.md)

## 🚀 Comandos y comprobaciones útiles

Construir una imagen (ejemplo genérico):

```bash
docker build -t educiber/pps10480035_<práctica>:<versión> .
```

Ejecutar contenedor (ejemplo genérico):

```bash
docker run -d --name <nombre> -p 80:80 -p 443:443 <imagen>
```

Comprobaciones rápidas:
- Logs: `docker logs -f <nombre>`
- HTTP simple: `curl -I http://localhost` (comprobar cabeceras)
- HTTPS: `openssl s_client -connect localhost:443` 
- VirtualHost test: `curl -H "Host: sitio.local" http://localhost`

## Notas y recomendaciones

- Mantén sincronizados los `Dockerfile` y los ficheros de configuración (`default-ssl.conf`, `hardened.conf`, `modsecurity.conf`, `evasive.conf`) entre prácticas.
- Revisa `owasp-crs/README.md` dentro de cada práctica cuando se use OWASP CRS para instrucciones adicionales.
- Corrige posibles typos en nombres de ficheros (`httpd-hardering.conf` → `httpd-hardening.conf`) para evitar confusión.

````
