# Payment Order Task

### The following are the instructions to setup project locally

`inside the project dir run the following`

```php
cp .env.example .env
```

### Set the following keys inside .env

```
DB_DATABASE
DB_USERNAME
DB_PASSWORD
PAYPAL_CLIENT_ID
PAYPAL_CLIENT_SECRET
PAYPAL_TEST_MODE
```

### Run The Following commands

```php
php artisan key:generate
php artisan migrate --seed
php artisan jwt:secret
```

#### Use The Following Credentials for login
```
email : test@test.com
password : password
```

### Postman
#### Postman collection Path
``public/Order_Payment.postman_collection.json``
#### Postman Config
edit ``base_url`` inside postman collection variables
