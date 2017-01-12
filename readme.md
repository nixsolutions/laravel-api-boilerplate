##Starting project steps
1. `composer install`;
2. `./vendor/bin/homestead make`;
3. Create .env file (copy config/env/.env.dev);
4. Generate app key `php artisan key:generate`;
5. Generate jwt secret `php artisan jwt:secret`;
6. `vagrant up`;
7. Under vagrant from project root `php artisan migrate && php artisan db:seed`;