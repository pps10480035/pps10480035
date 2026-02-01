📂 **Práctica 4: Mitigación de Ataques DoS con mod_evasive**

## 📝 Descripción de la Práctica
Esta práctica consiste en el endurecimiento del servidor Apache frente a ataques de Denegación de Servicio (DoS) y ataques de fuerza bruta. Para ello, se integra el módulo **mod_evasive**, el cual detecta comportamientos anómalos (muchas peticiones en muy poco tiempo desde una misma IP) y bloquea temporalmente al atacante.

## 🛠️ Archivos y Configuración
* **`Dockerfile`**: Basado en `httpd:2.4`, incluye la instalación de `libapache2-mod-evasive` y las herramientas de compilación necesarias.
* **`evasive.conf`**: Configuración de los umbrales de bloqueo:
    * `DOSPageCount`: Límite de peticiones a una misma página.
    * `DOSSiteCount`: Límite de peticiones totales al sitio.
    * `DOSBlockingPeriod`: Tiempo de bloqueo en segundos (devuelve un error 403).
* **`index.html`**: Archivo de prueba para recibir las peticiones.

## 🛡️ Comprobación con Apache Bench (ab)
Para verificar la eficacia del módulo, utilizamos la herramienta de benchmarking `ab` para estresar el servidor y forzar el bloqueo de la IP.

### Prueba de Estrés
Ejecutamos 1000 peticiones con una concurrencia de 20 para superar los umbrales de seguridad:
`ab -n 1000 -c 20 http://localhost:8080/index.html`

#### 📊 Análisis del Informe de Apache Bench
> [AQUÍ DEBES PEGAR EL TEXTO DEL INFORME GENERADO POR AB]
> **Nota técnica:** La comprobación final como se puede observar no se llego a completar, pero estan todas las reglas, y las restricciones son máximas, el ejercicio esta completado pero el resultado final falló.

#### 📸 Captura del Bloqueo

![imagen Resultado](/RA3/RA3_1/imagenes/pract4.png)

## 🚀 Guía de Despliegue
```bash
# Construcción de la imagen
docker build -t educiber/pps10480035_3.1:3.1.4 .

# Ejecución del contenedor
docker run -d --name mi-apache-seguro -p 8080:80 educiber/pps10480035_3.1:3.1.4
```
