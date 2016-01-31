Lotto game generator
===

Setup
---

* Clone the repository

* Download and install all PHP dependencies (you need composer installed, which is outside the scope of this document)

        $ composer install

* Setup database schema

        $ php artisan migrate

* Download and install build dependencies (please note, this includes Laravel's custom build tool Elixir which is huge. This command might take a long time to complete depending on your internet connection

        $ npm install

* Download and install front end dependencies

        $ ./node_modules/.bin/bower install

* Run the build process

        $ ./node_modules/.bin/gulp
Run Tests
---

    $ ./vendor/bin/phpunit
    
Why?
---

[See the orignal brief](brief.md)
