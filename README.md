# Clinical — Sistema de seguimiento de pacientes ✅

Breve: proyecto PHP para gestión de pacientes (registro, login, historias clínicas, nutrición, mensajes y adjuntos). La entrada inicial es `index.html` que redirige a `login.php`.

## Funcionalidad principal 🔧

- Registro de usuarios y verificación por email.
- Login con contraseñas hasheadas (en la mayoría de los flujos).
- Gestión de pacientes y fichas clínicas (crear/mostrar/editar).
- Carga de adjuntos (fotos, PDFs) asociados a fichas.
- Mensajería interna y panel de control.
- Recuperación de contraseña / verificación vía email.

## Cómo ejecutar 💡

1. Colocar `config.php` con credenciales de base de datos (no incluido).
2. Importar `mibase.sql` en MySQL.
3. Configurar credenciales SMTP en los scripts o mejor: usar variables de entorno.
4. Servir el directorio con un servidor web compatible con PHP.

## Problemas de seguridad importantes ⚠️

Al no utilizar un framework para este proyecto, el mismo posee vulnerabilidades que conviene corregir antes de cualquier prueba externa:

1. **SQL Injection** — existen consultas construidas concatenando `$_GET`/`$_POST` directamente (ej. `checklogin.php`, varios `form_*` y `elimina_*`). Recomendación: usar consultas preparadas (mysqli->prepare o PDO) y validar/normalizar entradas.

2. **Manejo de contraseñas/recuperación inseguro** — `password_recover.php` y `forgot-pass.php` envían o suponen contraseñas en texto plano y/o usan MD5. Evitar enviar contraseñas por email; implementar flujo de restablecimiento con tokens de un solo uso, generados con `random_bytes()` y almacenados con hash.

3. **Tokens débiles** — uso de `rand()` con pocos dígitos para tokens (fácil de adivinar). Usar `random_bytes()`/`bin2hex()` y expiración corta.

4. **Fugas de configuración y credenciales** — SMTP y otros secretos aparecen en el código. Mover secretos a `config.php` fuera del repo o a variables de entorno y añadirlo a `.gitignore`.

5. **Gestión de sesión insuficiente** — no se llama a `session_regenerate_id()` en login; no hay flags de cookie (`Secure`, `HttpOnly`, `SameSite`) ni invalidación correcta al expirar. Implementar regeneración y endurecer configuración de sesión.

6. **CSRF** — ausencia de tokens CSRF en formularios sensibles. Añadir tokens y validarlos en servidor.

7. **XSS** — salidas (por ejemplo nombres, mensajes) se imprimen sin escapado (`htmlspecialchars()`), lo que puede permitir XSS. Escapar toda salida basada en usuario.

8. **Subida de archivos insegura** — las cargas usan el nombre original, validan solo extensión y tamaño; no se verifica MIME ni se randomiza el nombre, ni se almacenan fuera del root público. Validar contenido, usar nombres aleatorios, limitar tipos y permisos, y servir archivos de forma segura.

9. **Información sensible en errores** — muchos errores devuelven SQL y mensajes de MySQL al usuario (fuga de información). Mostrar mensajes genéricos al usuario y loggear detalles internamente.

10. **Control de accesos** — revisar endpoints que modifican/eliminan datos para asegurar autorizaciones (roles/propietario) y evitar acciones por usuarios no autorizados.

## Recomendaciones rápidas (prioritarias) ✅

- Cambiar todas las consultas a prepared statements.
- Evitar enviar contraseñas por email; usar tokens robustos y de corta duración.
- Mover credenciales fuera del código y usar variables de entorno.
- Añadir CSRF tokens y aplicar escaping en todas las salidas.
- Regenerar session ID en login y establecer cookies seguras.
- Mejorar validación de archivos y almacenarlos fuera del webroot.
- Remover detalles de errores del output y habilitar logs.

---
Gracias.

TEST: http://fawsql.infinityfreeapp.com/
Usuario: x@x.com
Clave: 1234