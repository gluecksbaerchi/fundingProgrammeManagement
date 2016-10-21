# Funding Programme Management

## Installation

1. clone the project 
2. run ``composer install``
3. create ``.env`` file (have a look at ``.env.example``) and enter your db connection
4. create ``bootstrap/cache`` directory
5. run ``php artisan migrate``
6. run ``php artisan key:generate``
7. run ``bower install`` in ``/resources``

8. run ``php artisan db:seed`` (if you get the message " This cache store does not support tagging.
", set ``CACHE_DRIVER=array`` in your ``.env`` file)

## Template

using https://startbootstrap.com/template-overviews/sb-admin-2/