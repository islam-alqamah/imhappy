# Installation Saasify

---

- [Requirements](#section-1)
- [Download](#section-2)
- [Installation](#section-3)
- [Create new User](#section-4)

<a name="section-1"></a>

### Requirements

Saasify has been crafted with Laravel 8 and LiveWire, which have a few server requirements before installing. you will need to make sure your server meets the following requirements:

* PHP >= 7.3
* BCMath PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Node >= 14.6
* NPM >= 6.14.8
* Composer

<a name="section-2"></a>

### Downloading Saasify
Before you can install Saasify, you will need to download the latest version from codecanyon on your dashboard. <strong><a href="https://codecanyon.net/item/saasify-advance-laravel-saas-starter-kit/29651939" target="_blank">Buy Saasify now</a></strong>
> {warning} In order to download a copy of Saasify you have to buy it from Codecanyon.com.

After downloading the latest version of Saasify, extract the zip file and rename it.

Great ! you are ready to begin the installation.
<br><br>

<a name="section-3"></a>

#### 1. Create a New Database

Create a new MySQL database and save the credentials, you will need them to fill your .env file.
<br><br>

#### 2. Duplicate & Rename the ``` .env.example ``` file

Make sure to specify your Environment variables for your SaaS application. Duplicate ``` .env.example ```, and rename it to ```.env```.

```php
cp .env.example .env
```

Then, open up the .env file and update your DB_DATABASE, DB_USERNAME, and DB_PASSWORD in the appropriate fields. You will also want to update the APP_URL to the URL of your application.

```php 
APP_URL=http://your-url.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=saasify
DB_USERNAME=root
DB_PASSWORD=

STRIPE_KEY=Your-stripe-key
STRIPE_SECRET=Your-stripe-secret
CASHIER_CURRENCY=usd
TRIAL_DAYS_NO_PAYMENT_REQUIRE=10
ADMIN_EMAIL=your-admin-email
```
> {warning} Don't forget to fill SMTP info on ```.env``` file for your app to be able to send emails and also Stripe credentials to be able to create plans and subscriptions.

#### 3. Install Composer Dependencies

Install all the composer dependencies by running the following command:

```php
composer install
```

```php
npm install && npm run dev
```
<br>

#### 4. Run Migrations and Seeds your database
Migrate the database by runing :

```php
php artisan migrate
```

Next seed the database with the following command: :
```php
php artisan db:seed
```
<br>

#### 5. Linking The Storage Directory
you should link the `public/storage` directory to your `storage/app/public` directory. Otherwise, user profile photos stored on the local disk will not be available:

```php
php artisan storage:link
```
<br>

#### 6. Regenerate your application key
For security measures you may regenerate your application key, be sure to run the following command below:
```php
php artisan key:generate
```
<br>
🎉 Congratulations! You will now be able to visit your URL and see your new SaaS application up and running.

<a name="section-4"></a>
<br>

#### 7. Login to your application
You can login with credentials:
Email: `admin@admin.com` and Password: `admin123`
or register to create a new user.

### Billing & Subscription
The Next step is to setup stripe credentials and start create plans, coupons on admin dashboard.
For more info go to <a href="/{{route}}/{{version}}/subscription">Plan & Billing</a> section
