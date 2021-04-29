# API

---

- [API](#section-1)

Saasify includes first-party integration with Laravel Sanctum. Laravel Sanctum provides a featherweight authentication system for SPAs (single page applications), mobile applications, and simple, token based APIs. Sanctum allows each user of your application to generate multiple API tokens for their account. These tokens may be granted abilities / permissions which specify which actions the tokens are allowed to perform.
<strong><a href="https://laravel.com/docs/8.x/sanctum" target="_blank">Laravel sanctum doc</a></strong>

<a name="section-1"></a>

### API Token

API token creation panel may be accessed using the "API" link of the top-right user profile dropdown menu. From this screen, users may create Sanctum API tokens that have various permissions.

<img src="{{ asset('img/screens/api.png') }}">

### Defining Permissions

The permissions available to API tokens are defined using the `Jetstream::permissions` within your application's JetstreamServiceProvider. Permissions are just simple strings. Once they have been defined they may be assigned to an API token:

```php 
Jetstream::defaultApiTokenPermissions(['read']);

Jetstream::permissions([
    'create',
    'read',
    'update',
    'delete',
]);
```
### Authorizing Incoming Requests
Every request made to your Jetstream application, even to authenticated routes within your `routes/web.php` file, will be associated with a Sanctum token object. You may determine if the associated token has a given permission using the tokenCan method provided by the `Laravel\Sanctum\HasApiTokens` trait. This trait is automatically applied to your application's `App\Models\User` model during Jetstream's installation:
```php 
$request->user()->tokenCan('read');
```