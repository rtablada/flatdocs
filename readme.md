## FlatDoc for Laravel 4

This clean Markdown utility allows you to make awesome documentation quickly.

## Installation with [Laravel 4 Package Installer](https://github.com/rtablada/package-installer)

Simply run `php artisan package:install rtablada/flat-docs`

## Installation with Composer

In your composer.json add `'rtablada/flat-docs': 'dev-master'`

Then in your app/config/app.php add this to your Service Providers
`'Rtablada\FlatDocs\FlatDocsServiceProvider',`

## Publishing assets and configuration

Finally run these few commands:
```bash
php artisan asset:publish rtablada/flat-docs
php artisan config:publish rtablada/flat-docs
```

## Cofiguration
You can modify the configuration

## Creating your docs
### Declaring docs
Register the docs you would like available by modifying the 'registeredDocs' property in the config file. This will handle URI mapping as well as creating your navigation! Also, you can declare stubs vs. Pretty Titles by using the format `stub:pretty`. By the way, there is no limitation to the depths of your uris/documents!

```php
'registeredDocs' => array(
	'start:Getting Started',
	'api' => array(
		'1:endpoint1',
		'2:endpoint2',
	),
),
```
### Markdown Files
In your app path, place your docs in a 'docs' folder (this location can be modified in the config).
There order should match the way you want your uris.
So the file tree for the example would look like:
```
start.md
api/
	-1.md
	-2.md
```
