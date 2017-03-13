##Starting project steps

[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg?style=flat-square)](http://www.gnu.org/licenses/agpl-3.0)

1. `$ composer install`;
2. `$ ./vendor/bin/homestead make`;
3. Generate jwt secret `php artisan jwt:secret`;
4. `$ vagrant up`;
5. Under vagrant from project root `$ php artisan migrate && php artisan db:seed`.
