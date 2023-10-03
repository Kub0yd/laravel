# Приложение SF-AdTech — трекер трафика
Проект тестировался на wsl.
## Установка
Установите [laravel](https://laravel.com/docs/10.x/installation).  
Поставьте [laravel-websockets](https://beyondco.de/docs/laravel-websockets/getting-started/introduction).   
Скопируйте репозиторий [github.com](https://github.com/Kub0yd/laravel)  

Переименуйте файл [.env.example](.env.example) в .env  
В файле [AdminSeeder.php](/database/seeders/AdminSeeder.php) задайте пароль администратора:  

        'password' => Hash::make('12341234')

Выполните миграции:

        php artisan migrate
Выполните сидирование:

        php artisan db:seed --class=DbSeeder


Запустите WebSockets командой:

        php artisan websockets:serve

Запустите менеджер пакетов:

        npm run dev

Перейдите на адрес, указанный в строке APP_URL вашего [.env](.env) файла 

## Описание классов
[Контроллеры](/app/Http/Controllers/AdTech/Readme.md)  
[Сервисы](/app/Services/readme.md)
## Модели
[App/Models/AdTech](./app/Models/AdTech/)
## JS
[main.js](./public/js/main.js) - для основной страницы  
[admin.js](./public/js/admin.js) - панель администратора  
Подключенные каналы:
[app.js](./resources/js/app.js)  
[adminApp.js](./resources/js/adminApp.js)  

## Начало работы
Назначьте роли зарегистрированным пользователям в панели администратора (/admin) в разделе управление:
![](/pic/1.png)
webmaster - роль позволяет пользователю подписываться на оффер и просматривать список доступных офферов.  
creator - роль позволяет пользователю создавать офферы.  
admin - открывает доступ к панели администратора.  
## License
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
