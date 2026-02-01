📂 **Práctica 2: Integración de WAF con ModSecurity en Apache**

## 📝 Descripción de la Práctica
En este ejercicio se implementa un **Web Application Firewall (WAF)** utilizando el módulo `mod_security2`. El objetivo es añadir una capa de inteligencia al servidor Apache para que sea capaz de inspeccionar el tráfico entrante y denegar peticiones maliciosas basadas en reglas predefinidas.

## 🛠️ Archivos Utilizados y Modificados
* **`Dockerfile`**: Configura la imagen base `httpd:2.4`, instala las dependencias de ModSecurity, activa los módulos necesarios (`unique_id`, `headers`, `ssl`) y orquesta la copia de los ficheros de configuración.
* **`modsecurity.conf`**: Contiene el motor de reglas activo (`SecRuleEngine On`) y una **regla manual personalizada** (ID:1) para detectar inyecciones.
* **`hardened.conf`**: Aplica directivas de bastionado como la ocultación del banner del servidor.
* **`server.crt / .key`**: Certificados para habilitar la capa SSL.

## 🛡️ Comprobación del Sistema de Seguridad
Para verificar que Apache se atiene a las reglas de ModSecurity, realizamos una prueba de intrusión simulada.

### Paso 1: Acceso legítimo
Al acceder de forma normal, el servidor responde correctamente.
> **URL:** `http://localhost:8080` -> **Resultado:** 200 OK

### Paso 2: Intento de inyección (Bloqueo activo)
Utilizamos el parámetro configurado en nuestra regla personalizada para forzar el bloqueo.
> **URL:** `http://localhost:8080/?dato=script`

#### 📸 Captura del resultado

![imagen Resultado](/RA3/RA3_1/imagenes/pract2.png)

## 🚀 Guía de Despliegue
```bash
# Construir la imagen
docker build -t educiber/pps10480035_3.1:3.1.2 .

# Levantar el contenedor
docker run -d --name mi-apache-seguro -p 8080:80 -p 8443:443 educiber/pps10480035_3.1:3.1.2
```
