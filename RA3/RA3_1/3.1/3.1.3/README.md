📂 **Práctica 3: Implementación de Reglas OWASP CRS en ModSecurity**

## 📝 Descripción de la Práctica
En esta fase, evolucionamos nuestro WAF integrando el conjunto de reglas **OWASP Core Rule Set (CRS)**. A diferencia de las reglas manuales, OWASP proporciona una firma genérica de ataques para proteger aplicaciones web contra el "Top 10" de vulnerabilidades de seguridad web.

## 🛠️ Archivos y Cambios Clave
* **`Dockerfile`**: Se añaden comandos para descargar o copiar el repositorio oficial de reglas OWASP CRS a `/usr/local/apache2/conf/extra/owasp-crs/`.
* **`modsecurity.conf`**: Se configura para incluir (Include) el archivo `crs-setup.conf` y todas las reglas del directorio `rules/*.conf`.
* **`index.html`**: Web base para pruebas de conectividad.

## 🛡️ Protocolo de Comprobación de Seguridad
Al tener activadas las reglas OWASP, el servidor bloqueará patrones de ataque complejos automáticamente.

### 1. Prueba de Inyección SQL (SQLi)
Intentamos simular un acceso administrativo saltándonos el login con una sentencia SQL clásica.
* **URL:** `http://localhost:8080/?id=1' OR '1'='1`
* **Resultado:** **403 Forbidden**. Las reglas OWASP detectan el operador `' OR '` como un ataque de inyección.

### 2. Prueba de Inyección de Comandos (OS Command Injection)
Intentamos leer el archivo de contraseñas del sistema a través de la URL.
* **URL:** `http://localhost:8080/?exec=../../etc/passwd`
* **Resultado:** **403 Forbidden**. El motor detecta el "Path Traversal" (intento de navegación por directorios del sistema).

#### 📸 Captura Requerida

![imagen Resultado](/RA3/RA3_1/imagenes/pract3.png)

## 🚀 Guía de Despliegue
```bash
# Construcción de la imagen profesional
docker build -t educiber/pps10480035_3.1:3.1.3 .

# Despliegue del contenedor (Nombre de contenedor según historial)
docker run -d --name mi-apache-seguro -p 8080:80 educiber/pps10480035_3.1:3.1.3
```
