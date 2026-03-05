# Práctica RA3.2: Pentesting con Damn Vulnerable Web Application (DVWA)

Este proyecto consiste en la exploración y análisis de vulnerabilidades web utilizando DVWA, una aplicación diseñada específicamente con fines educativos para practicar técnicas de hacking ético y seguridad ofensiva.

## 📋 Descripción de la Práctica

El objetivo central es identificar, explotar y comprender vulnerabilidades comunes en aplicaciones web para luego proponer medidas de mitigación. Durante el desarrollo, se trabaja el nivel de seguridad Medium.

Las vulnerabilidades abordadas incluyen:

- Inyección SQL (SQL Injection)
- Cross-Site Scripting (XSS)
- Cross-Site Request Forgery (CSRF)
- Ejecución de comandos remotos
- Inseguridad en la gestión de sesiones y autenticación

## 📖 Guía de Ejercicios

Para la realización de esta práctica, se han seguido los tutoriales y resoluciones detalladas en el siguiente recurso:

🔗 https://aftabsama.com/writeups/dvwa/

**Nota:** Se deben completar todas las actividades correspondientes al nivel MEDIUM indicado en dicha guía.

## 🛠️ Configuración del Entorno (Docker)

### Requisitos Previos

Asegúrate de tener instalado Docker en tu sistema. Si no lo tienes, puedes descargarlo desde el sitio oficial de Docker Desktop.

### Descargar la Imagen y Ejecutar el Contenedor

Utilizaremos la imagen oficial de DVWA. Ejecuta el siguiente comando en tu terminal para descargarla y ponerla en marcha:

```bash
docker run --rm -it -p 80:80 vulnerables/web-dvwa
```

### Acceso a la Aplicación

Una vez que el contenedor esté corriendo:

- Abre tu navegador y accede a http://localhost.
- Inicia sesión con las credenciales por defecto:
  - Username: admin
  - Password: password
- Haz clic en el botón "Create / Reset Database" al final de la página de configuración para inicializar la base de datos.

## ⚠️ Aviso Importante

Este proyecto se realiza exclusivamente en un entorno controlado y con fines educativos. El uso de estas técnicas sobre sistemas sin autorización previa es ilegal. El propósito es fortalecer los conocimientos en ciberseguridad para construir aplicaciones más seguras en el futuro.