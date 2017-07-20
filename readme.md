
[![PHP >= 7+](https://img.shields.io/badge/php-%3E%3D%207-8892BF.svg?style=flat-square)](https://php.net/)
[![Build Status](https://secure.travis-ci.org/nixsolutions/laravel-api-boilerplate.png?branch=master)](https://travis-ci.org/AlexFloppy/laravel-api-boilerplate)
[![Coverage Status](https://coveralls.io/repos/github/nixsolutions/laravel-api-boilerplate/badge.svg?branch=master)](https://coveralls.io/github/nixsolutions/laravel-api-boilerplate?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/nixsolutions/laravel-api-boilerplate/badges/quality-score.png)](https://scrutinizer-ci.com/g/nixsolutions/laravel-api-boilerplate/?branch=master)
[![License: AGPL v3](https://img.shields.io/badge/License-AGPL%20v3-blue.svg?style=flat-square)](http://www.gnu.org/licenses/agpl-3.0)
[![Dependency Status](https://www.versioneye.com/user/projects/58c6d1f87a7954003a3cacfc/badge.svg?style=flat-square)](https://www.versioneye.com/user/projects/58c6d1f87a7954003a3cacfc)

## Setup development environment with Homestead (per-project installation)

1. Clone project
2. `$ composer install`;
3. Setup homestead/vagrant environment:
	
    ```
    ./vendor/bin/homestead make
	```

	> Remove the following lines from Homestead.yaml if you don't have this SSH keys on your machine (http://laravel.com/docs/5.0/homestead#installation-and-setup):
	> 
        authorize: ~/.ssh/id_rsa.pub
        keys:
            - ~/.ssh/id_rsa
	  
4. Generate jwt secret `php artisan jwt:secret`;
5. Run vagrant
	
    ```
    vagrant up
    ```
    
6. Under vagrant from project root `$ php artisan migrate && php artisan db:seed`.
7. Finally, browse [http://192.168.10.10](http://192.168.10.10), you should see the main page of application.

Demo
-------------------------
### Install json-api demo
To install the json-api demo run the command:

    php artisan make:demo 
        {--force : Overwrite existing files by default}
        
Once it is up and running, go to the following address in your browser:

    http://192.168.10.10/api/v1/skills
    
## Testing

To run the tests:

    vagrant ssh
    cd /vagrant
    vendor/bin/phpunit


