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
9. si queremos utilizar mysql, actualizar en .env
# MySQL CONFIG
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=students
# DB_USERNAME=root
# DB_PASSWORD=root    


10. para corregir bug al realizar la migración, agregar al fichero app\Providers\AppServiceProvider.php 

 public function boot()
    {
        // agregar
         Schema::defaultStringLength(191);
    }

