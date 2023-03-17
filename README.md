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
- PHP-8.1
- Laravel-10

### ENV Setup 
- You have to setup database related credentials properly in .env
- You have to setup mail related credentials properly.
- You have to setup QUEUE_CONNECTION=database to run Queue for sending mail



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

### Runnig Queue before send email 
goto .env file & update `QUEUE_CONNECTION=database` and then run the following command

```bash
php artisan queue:work
```

### Alternatively, you may run the queue:listen command.
```bash
php artisan queue:listen
```

### Run Test 
```bash
php artisan test
```

### To Test CORN JOB 
```bash
php artisan reminder:send
```


### Packages what I extra used
- #### [Artisan View](https://github.com/svenluijten/artisan-view)
- #### [laravel Pint](https://github.com/laravel/pint)
- #### [Guzzle](https://docs.guzzlephp.org/en/stable/index.html)


### What I have done
- User can registration for Covid Vaccine.
- User can check registration status
- You (Reviewer) can see all vaccine center list
- You (Reviewer) can see all authenticate users list
- Try to use Repository Pattern
- Used datatable to show all list
- Testing
- Corn Job setup for sending email to the registered user at 09:00 PM before 1 day ago of their vaccine schedule date.
- Mail sent asynchronously

### About the project & my limitation
I followed the [Surokkha](https://surokkha.gov.bd/) which is Bangladeshi website to register for COVID Vaccine and I try to develope this system like this.

There are few steps to register. 

 - Step-1 : User Identification: User have to input their NID number and Birth Date. If it's successful, then it'll goto next step otherwise it'll give you error message.

 - Step-2 : User Information: After verified  their NID and birth date, it'll redirect the user into this page. Here user can not change their name and gender but he can input the mobile, email, can select center and finally have to check the checkbox.

 - Step-3 : Final Step - Confirmation: after done all procedure a 6 digit OTP number will be send the user email id. He have to input that OTP number. After matching the OTP, it redirects success page and also the user get a successfull email notification. 
   
Due to time limit I can't add all field. But I try to add at least minimum functionality which are mandatory. I created a normal design because I mainly focus on backend part not in design part.



### About performance for the `User Registration` and `Search`

Though I try to make a better performance to build this system but If I had more time, I would also recommend the following additional optimizations: -

- I would make this system to SPA (Single Page Optimization). And I'll definitely use REACT.js.  
- Caching: Use caching mechanisms like Redis or Memcached to store frequently accessed data such as user records or search results. This can significantly reduce the time taken to fetch data from the database.
- Eager Loading: When querying the database for user records or search results, use eager loading to load related data in a single query, instead of making multiple queries. This can help reduce the number of queries made to the database, improving performance.
- Queues: Use Laravel's queue system to offload time-consuming tasks like sending emails or processing data in the background, freeing up server resources for faster user registration and search.
- Optimize Images: Optimize images to reduce their file size and load times. This can help improve the overall performance of the application, especially if I have a lot of images on the site.




#### `Note: In home page when you will run this project, you will see 4 type of option to click and goto the features.`
