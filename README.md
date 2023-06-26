# bikes
Una prueba de API PLATFORM

# Tecnologías usadas
- PHP 8.2
- Api platform
- Symfony 6

# Base de datos
 - MySql

# Control de calidad
 - friendsofphp/php-cs-fixer - para el code style
 - vimeo/psalm - Añadido con el plugin de symfony para prevenir problemas de tipado
 - phpunit/phpunit - test unitarios

# Instalación
 - Clona el repositorio
 - Entra en la carpeta
 - Ejecuta `composer install`
 - Edita el fichero .env para configurar tu base de datos
 - Ejecuta desde la linea de comandos 
   - `php bin/console doctrine:database:create`
   - `php bin/console doctrine:schema:create`

# Ejecución (Windows)
 - Levanta tu servidor Mysql
 - Levanta el servidor de symfony usando
 `symfony server:start`
 - Ejecuta desde tu navegador  `http://localhost:8000/api`
 - Para ejecutar los tests `php vendor/bin/phpunit`
 - Para ejecutar PSALM `php vendor/bin/psalm`

# Consideraciones
Dado el limitado tiempo para este prototipo, he preferido hacer un poco de todo, para poder mostrar el mayor abanico de posibilidades posibles, incluyendo:
 - Uso de API PLATFORM para crear una API
 - Uso de eventos en API platform y suscriptores
 - Uso de validadores custom en el symfony validator y manipulación del contexto de validacion en los tests
 - Control de calidad de PSALM a nivel 1
 - Uso de queries de doctrine en los validadores, desde el repositorio de la entidad
 - Tests unitarios usando data providers, mocks de dependencias y expectativas de ejecución.
 - Tests unitarios a un 100% de coverage en los archivos seleccionados

De tener mas tiempo, hubiese estado genial añadir:

 - Validaciones adicionales (rental no debe asignar la fecha de inicio antes de hoy por ejemplo)
 - Virtualizacion (usando un docker-compose para levantar un phpfpm y un mysql, por ejemplo con https://hub.docker.com/r/bitnami/symfony/#!)
 - Tests de aceptación (de acuerdo a https://api-platform.com/docs/distribution/testing/)
 - Tipados: hubiese estado bien cambiar los datetimes de rental por strings con forma de fecha, aunque para este prototipo por simplificar me parecio mejor dejarlo como DateTime
