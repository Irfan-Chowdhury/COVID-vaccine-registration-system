<div align='center'>

# COVID Vaccine Registration System

</div>

<!-- ## Authentication
<h4>Install Laravel UI Package</h4>

```bash
composer require laravel/ui
```

<h4>Generate auth scaffolding</h4>

```bash
php artisan ui vue --auth
``` -->

## How to run this project

### Configuration
- PHP-8.2
- Laravel-10

### ENV Setup 
- You have to setup database related credentials properly in .env
- You have to setup mail related credentials properly.



### Migrate 
<h5>Just run this command</h5>

```bash
php artisan migrate
```

### Seeder

```bash
php artisan db:seed
```

### Update Your Composer 
```bash
composer update
```

### Generate APP_KEY
```bash
php artisan key:generate
```

### Run Project 
```bash
php artisan serve
```

### Packages what I extra used
- #### [Artisan View](https://github.com/svenluijten/artisan-view)
- #### [laravel Pint](https://github.com/laravel/pint)
- #### [Guzzle](https://docs.guzzlephp.org/en/stable/index.html)


### Run Test 
```bash
php artisan test
```

### What I have done
- Try to implement Repository Pattern
- Used datatable to show all list
- Testing


### About performance for the `User Registration` and `Search`

Though I try to make a better performance to build this system but If I had more time, I would also recommend the following additional optimizations: -

- I would make this system to SPA (Single Page Optimization). And I'll definitely use REACT.js.  
- Caching: Use caching mechanisms like Redis or Memcached to store frequently accessed data such as user records or search results. This can significantly reduce the time taken to fetch data from the database.
- Eager Loading: When querying the database for user records or search results, use eager loading to load related data in a single query, instead of making multiple queries. This can help reduce the number of queries made to the database, improving performance.
- Queues: Use Laravel's queue system to offload time-consuming tasks like sending emails or processing data in the background, freeing up server resources for faster user registration and search.
- Optimize Images: Optimize images to reduce their file size and load times. This can help improve the overall performance of the application, especially if I have a lot of images on the site.
