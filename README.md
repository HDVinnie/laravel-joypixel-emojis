# laravel-joypixel-emojis <img alt="❤️" width="30" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png">

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[![Software License][ico-license]](LICENSE)

<img alt="😀" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f600.png"> <img alt="🏋🏼" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f3cb-1f3fc.png"> <img alt="❤️" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png"> <img alt="☮" width="50" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/262e.png">


Laravel package to make it easier working with the modern emojis from [Joypixels](https://joypixels.com/).


## installation
Via Composer

```bash
$ composer require "hdvinnie/laravel-joypixel-emojis"
```
```bash
$ composer update
```

__If you are on a Laravel that does not have Auto Discovery or you have it disabled then you need to add the following to your `config/app.php` file:__

Add the ServiceProvider to the providers array in `config/app.php`

``` php
hdvinnie\LaravelJoyPixels\LaravelJoyPixelsServiceProvider::class,
```

Add this to the aliases array in `config/app.php`

``` php
'LaravelJoyPixels' => hdvinnie\LaravelJoyPixels\LaravelJoyPixelsFacade::class,
```

Config:

``` bash
$ php artisan vendor:publish --tag=config --provider="hdvinnie\LaravelJoyPixels\LaravelJoyPixelsServiceProvider"
```

## Usage

``` php
LaravelJoyPixels::toShort($str); // - native unicode -> shortnames
LaravelJoyPixels::shortnameToImage($str); // - shortname -> images
LaravelJoyPixels::unicodeToImage($str); // - native unicode -> images
LaravelJoyPixels::toImage($str); // - native unicode + shortnames -> images (mixed input)
```

Blade (equivalent to `LaravelJoyPixels::toImage($str)`):

`@joypixels(':smile:')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/64/1f600.png">

`@joypixels(':smile: ❤️')` -> <img alt="😀" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/1f600.png"><img alt="❤️" width="20" src="https://cdn.jsdelivr.net/emojione/assets/4.0/png/128/2764.png">

🚨 The output is not escaped so be careful with what you pass into `@joypixels`.

More details about how `toImage($str)` works can be found at [https://github.com/Ranks/emojione/blob/master/examples/PHP.md](https://github.com/Ranks/emojione/blob/master/examples/PHP.md)

### Example
You want to let users put emoji a comment.
When you are saving a comment, you might want to run the content through `LaravelJoyPixels::toShort($str)` to convert `😄` and other emoji to `:smile:` etc.

```php
Comment::create([
  'content' => LaravelJoyPixels::toShort(request('content'))
]);
```
So if someone leaves a comment like `This is an awesome comment 😄🔥` it will be saved as `This is an awesome comment :smile: :fire:`

In your view where you display your comments you can use

```php
@joypixels($comment->content)
```
and that will convert `:smile:` and `😄` to the emojione equivalent.


## Assets
By default it will use the assets from JSDelivr.

Remember to run this before trying to publish any of the assets:

```bash
composer require joypixels/assets
```

If you want to serve the assets yourself you can publish them with the following commands. Remember to update `config/joypixels.php`

PNG files in sizes 32/64/128:

``` bash
$ php artisan vendor:publish --tag=public --provider="hdvinnie\LaravelJoyPixels\LaravelJoyPixelsServiceProvider"
```

In `config/joypixels.php` specify the local path. Remember to specify which size you want in the path (32/64/128).

```php
'imagePathPNG' => '/vendor/joypixels/png/64/',
```

### Sprites
If you want to use sprites:

``` bash
$ php artisan vendor:publish --tag=sprites --provider="hdvinnie\LaravelJoyPixels\LaravelJoyPixelsServiceProvider"
```

In `config/joypixels.php` enable sprites:

```php
'sprites' => true,
'spriteSize' => 32, // 32 or 64
```

Add the stylesheet to your HTML:

```html
<link rel="stylesheet" href="/vendor/joypixels/sprites/emojione-sprite-{{ config('emojione.spriteSize') }}.min.css"/>
```
