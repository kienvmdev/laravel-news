# Laravel News API with Admin Panel
Laravel 8 Admin Panel with API using Jetstream, Livewire, Sanctum, and Tailwind.

1. `git clone https://github.com/kienvmdev/laravel-news.git`
2. `cd laravel-news`
3. `composer install`
4. Rename or copy `.env.example` file to `.env`
5. `php artisan key:generate`
6. Set your database credentials in `.env` file
7. `php artisan migrate:fresh --seed`
8. `php artisan storage:link`
9. `npm install && npm run dev`
10. `php artisan serve`
11. Visit `localhost:8000/login` in your browser
12. Choose one `email` id from `users` table. Password is `password`.

### Code explanation

**All tutorial links**
* [Visit mditech.net](https://mditech.net/laravel-tutorial/)

*Part 1:* **Create Migration, Model, and Factory to start with the project**
* [Read on medium.com](https://madhavendra-dutt.medium.com/how-to-seed-test-data-into-a-database-in-laravel-ec1b7defe552)

*Part 2:* **Establish Relationships**
* [Read on medium.com](https://madhavendra-dutt.medium.com/database-relationship-6780f4eab72a)

*Part 3:* **API Resources, API Controllers, and API Routes**
* [Read on medium.com](https://madhavendra-dutt.medium.com/creating-and-consuming-restful-api-in-laravel-7dc116430b3)

*Part 4:* **Front End for Admin Dashboard on Web inteface**
* [Read on medium.com](https://madhavendra-dutt.medium.com/creating-the-front-end-in-laravel-using-jetstream-livewire-72d140c6c946)

Do check [Laravel Documentation](https://laravel.com/docs/8.x) if you have any doubt.
