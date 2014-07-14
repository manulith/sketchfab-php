# Sketchfab PHP

This is a Laravel package for uploading 3D objects to the Sketchfab API.

## Installation

1. Add `"manulith/sketchfab-php": "dev-master"` to **composer.json**.
2. Run `composer update`
3. Add `Manulith\SketchfabPhp\SketchfabPhpServiceProvider` to the list of providers in **app/config/app.php**.
4. Publish your config

```
$ php artisan config:publish manulith/sketchfab-php
```

Then, set your API key in `app/config/packages/manulith/sketchfab-php/config.php`

## Usage

### Upload an object

Simple:


```php
<?php
$file = '/path/to/file.stl';
$response = Sketchfab::upload($file);
echo $response['uid'];
```

With optional parameters:

```php
<?php
$file = '/path/to/file.stl';
$options = array(
	'name'        => 'My awesome object',
	'description' => 'This is just a test file.',
	'tags'        => 'awesome fun',
	'private'     => true,
	'password'    => 'letmein',
);
$response = Sketchfab::upload($file, $options);
echo $response['uid'];
```

### Check status of an object

```php
<?php
$response = Sketchfab::status('cnTC9viItfZ1fdT811NgEVafw1S');
echo $response['processing'];
```

### Get oEmbed info for an object

```php
<?php
$response = Sketchfab::info('cnTC9viItfZ1fdT811NgEVafw1S');
print_r($response);
```

### Embed an object

Simple:

```php
<?php
echo Sketchfab::embed('cnTC9viItfZ1fdT811NgEVafw1S');
```

With optional parameters:

```php
<?php
$options = array(
	'width'       => 320, // or '100%'
	'height'      => 280,
	'ui_infos'    => 1,
	'ui_controls' => 1,
	'ui_stop'     => 1,
	'autostart'   => 1,
);
echo Sketchfab::embed('cnTC9viItfZ1fdT811NgEVafw1S');
```
