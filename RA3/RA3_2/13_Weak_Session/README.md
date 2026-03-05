# Ejercicio 13: Weak Session IDs (Nivel: Medium)

Este módulo se centra en la inseguridad en la gestión de sesiones, específicamente cuando los identificadores de sesión (Session IDs) son generados siguiendo patrones predecibles, lo que permite a un atacante secuestrar sesiones de otros usuarios.

## 📑 Descripción del Escenario

En el nivel Medium, la aplicación genera un nuevo valor para la cookie dvwaSession cada vez que se pulsa el botón "Generate". A diferencia del nivel bajo, donde el ID es un simple contador incremental, el nivel medio utiliza un método basado en el tiempo para generar el identificador.

## 🛠️ Herramientas Utilizadas

- DVWA (Desplegado en Docker).
- Herramientas de Desarrollador (Pestaña Storage): Para inspeccionar los valores de las cookies en tiempo real.
- Análisis de Época (Unix Timestamp): Para identificar el patrón de generación.

## 🚀 Ejecución del Ataque

El objetivo es demostrar que el ID de sesión no es aleatorio y, por lo tanto, es vulnerable a ataques de predicción.

### 1. Observación de Patrones

Al generar varios IDs de sesión de forma consecutiva, se observa que los valores son números enteros largos que aumentan ligeramente en cada petición.

### 2. Análisis del Valor

El valor observado en la captura de pantalla para la cookie dvwaSession es 1772653717.

- Este número corresponde a un Unix Timestamp (el número de segundos transcurridos desde el 1 de enero de 1970).
- Un atacante que conozca el momento exacto en el que un usuario inició sesión podría predecir con total exactitud su ID de sesión y suplantar su identidad sin necesidad de credenciales.

## 📸 Evidencia de Explotación

Como se observa en la captura:

- La herramienta de inspección de almacenamiento (Storage) del navegador muestra la cookie dvwaSession.
- El valor actual es 1772653717.
- Se confirma que la seguridad está configurada en Medium.
- El hecho de que el ID sea un simple timestamp facilita enormemente los ataques de fijación o secuestro de sesión (Session Hijacking).

  ![Captura del Resultado](../images/commmand_injection2.png)

## ✅ Conclusión y Mitigación

La predictibilidad en los IDs de sesión anula cualquier otro mecanismo de autenticación robusto. Para corregir esta vulnerabilidad y cumplir con los objetivos del RA3, se deben aplicar las siguientes soluciones:

- Generadores de Números Pseudoaleatorios Criptográficamente Seguros (CSPRNG): Utilizar funciones del sistema que garanticen una alta entropía y aleatoriedad en los IDs.
- Longitud y Complejidad: Los IDs deben ser suficientemente largos y complejos para que el ataque por fuerza bruta sea computacionalmente inviable.
- Regeneración de Sesión: Cambiar el ID de sesión inmediatamente después de que el usuario se autentique con éxito.

Recuerda: Este ejercicio se ha realizado en un entorno controlado con fines exclusivamente educativos.