##Starting project steps

1. `$ composer install`;
2. `$ ./vendor/bin/homestead make`;
3. Generate jwt secret `php artisan jwt:secret`;
4. `$ vagrant up`;
5. Under vagrant from project root `$ php artisan migrate && php artisan db:seed`.
