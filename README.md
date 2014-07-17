mcl
===

Quick start
===
### Required setup

In the require key of composer.json file add the following

```php
"msamec/mcl": "dev-master"
```

Run the Composer update comand
```php
$ composer update
```
In your config/app.php add 'Msamec\Mcl\MclServiceProvider' to the end of the $providers array

```php
'providers' => array(

    'Illuminate\Foundation\Providers\ArtisanServiceProvider',
    'Illuminate\Auth\AuthServiceProvider',
    ...
    'Msamec\Mcl\MclServiceProvider',

),
```

### Usage
#### Model
In models directory instead of creating .php file, create folder with the same name you would name previous said model. For example if you wanted to create model User.php, instead you would create folder Something. Inside that folder create .php file named Main.php. This file will be used as a fallback if a file for certain role does not exist. It should look something like this:
```php
|-- app
|   |-- models
|   |   |-- Something
|   |   |   |-- Main.php
```
Main.php must have namespace because for every model(folder) you create, it must contain class Main. 

Example:
```php
<?php namespace Something;
class Main extends Eloquent {
  public static function foo(){
    echo 'foo';
  }
}
```

Next you can create class for different roles you have.
<dl>
  <dt>Note</dt>
  <dd>If one of your roles does one thing and other roles all do the same thing. You don't need to create role class for every role you have and define same behaviour in every class. Define default behaviour in your Main class and MCL will fallback to that class if class for certain role does not exist.</dd>

</dl>

Next we will create class for User role and name it User.php. It is recommended that you name role classes same name as roles in you app.

```php
|-- app
|   |-- models
|   |   |-- Something
|   |   |   |-- Main.php
|   |   |   |-- User.php
```

```php
<?php namespace Something;
use Something\Main;
class User extends Main {
  public static function bar(){
    echo 'bar';
  }
}
```

General method for calling those models looks like this:

```php
Mcl::model('namespace', 'function name', 'role', 'arg1', 'arg2', ...);
```

Examples:
```php
Mcl::model('Something', 'bar', 'User');
Mcl::model('Something', 'foo', 'User');
Mcl::model('Something', 'foo', 'NonExistantClass');
```

Results:
```php
bar
foo
foo
```

#### View
