# api-laravel
ejemplo de api en laravel v1.0

Pasos
1. agregar php a las variables de entorno
2. crear proyecto
    composer create-project laravel/laravel api
3. iniciar proyecto
    php artisan serve
4. instalar api
    php artisan install:api
5. crear migracion
    php artisan make:migration create_students_table
6. ejecutar migracion
    php artisan migrate
7. crer modelo
    php artisan make:model Student
8. crear controlador
    php artisan make:controller StudentsController    