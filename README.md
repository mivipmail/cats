## Веб приложение - CRUD для кошек и их пород

Проект использует:

- Laravel 9
- Vue 3 (Composition API)
- Vue-Router
- Vuex
- Element plus
- [API для картинок с кошками](https://thecatapi.com)

Вся логика работы для скачивания картинок - в классе App\Lib\CatImageUploader

В public нужно создать символическую ссылку на storage командой 'php artisan storage:link'

Чтобы первично наполнить базу - нужно запустить в терминале 'php artisan migrate --seed'