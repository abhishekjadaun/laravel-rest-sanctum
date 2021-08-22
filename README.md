
# Laravel Rest Api

This project is laravel rest api project with features like add, edit, delete ,get api with Laravel Sanctum authentication.


## Installation

Clone or download this project.


## Getting Started

Step 1: setup database in .env file

Step 2:create controller
```bash
php artisan make:controller UserController
```
Step 3:Install Laravel Sanctum.
```bash
composer require laravel/sanctum
```

Step 4:Publish the Sanctum configuration and migration files .
```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```
Step 5:create model
```bash
php artisan make:model Userinfo
import 
use Laravel\Sanctum\HasApiTokens;
```
Step 6:database migrations
```bash
php artisan migrate
```
Step 7:Add Sanctum's middleware.
```bash
../app/Http/Kernel.php

use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

...

    protected $middlewareGroups = [
        ...

        'api' => [
            EnsureFrontendRequestsAreStateful::class,
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    ...
],
```

Step 8:create seeder for the Userinfo model
```bash
php artisan make:seeder UserinfosTableSeeder
```

Step 9:insert values
```bash
import 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

DB::table('userinfos')->insert([
    'name' => 'abhi',
    'email' => 'abhi@abhi.com',
    'password' => Hash::make('123456')
]);
```
Step 10:seed table
```bash
php artisan db:seed --class=UserinfosTableSeeder
```
Step 11:import in UserController
```bash
use App\Models\Userinfo;
use Validator;
use Illuminate\Support\Facades\Hash;
```
Step 12:Api urls
1. Add User using Postman (Post Request)
```bash
http://127.0.0.1:8000/api/add
{
    "name":"test",
    "email":"test@test.com",
    "password":"123456"
}
```
2. Generate Token (Post Request)
```bash
http://127.0.0.1:8000/api/login
{
    "user": {
        "id": 13,
        "name": "test",
        "email": "test@test.com",
        "password": "$2y$10$f3gLqeXZ2lBKymDjn5HjQO6XoID6DvoVseNn2lGL7bWmrH72KdzTe"
    },
    "token": "9|v4BQn...."
}
```
3.Send Requests using token
```bash
http://127.0.0.1:8000/api/data
http://127.0.0.1:8000/api/data/id
http://127.0.0.1:8000/api/update
http://127.0.0.1:8000/api/search/keyword
http://127.0.0.1:8000/api/delete
http://127.0.0.1:8000/api/upload

```