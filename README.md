# push

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a `Laravel 5 Package` for [**Pushwoosh**](https://www.pushwoosh.com) Notification Integration. This package currently supports `IOS & Android` other support is coming soon. 
This package is built upon [gomoob/php-pushwoosh](https://github.com/gomoob/php-pushwoosh) package. With feew tweeks and Laravel 5 Compatibility.

## Install

Via Composer

``` bash
$ composer require tzsk/push
```

## Configure

` config/app.php `
```php
'providers' => [
    ...
    Tzsk\Push\Provider\PushServiceProvider::class,
    ...
],

'aliases' => [
    ...
    'Push' => Tzsk\Push\Facade\Push::class,
    ...
],
```

To publish the Configuration file in `config/push.php` Run:
```bash
php artisan vendor:publish
```

## Usage

``` php
use Tzsk\Push\Facade\Push;
...
$response = Push::send("Message Text", function($push) {
    $push->setToken("Device Token");
    # OR...
    $push->setTokens(["Device 1", "Device 2"])
        ->setTitle("You have a new notification") # For Android.
        ->setBody("Message Text") # To override the Message. Optional.
        ->setBadge(1) # Default: 1.
        ->setPayload(["type" => "ANYTHING", "data" => [] ]) # Default: []
        ->setIcon("http://path/to/icon.png") # For Android.
        ->setSmallIcon("pw_notification.png") # For Android.
        ->setBanner("http://path/to/banner.png") # For Android. Optional.
        ->setSound("res/sound/file/path") # Default: "default"
        ->setPriority(1) # Default: 1 
        ->setVibration(1) # Default: 1
        ->setIbc("#ffffff"); # Icon Background Color. Default: '#ffffff'
});

if ($response->isOk()) {
    # Successfully Sent.
} else {
    # Something went wrong.
    echo $response->getStatusMessage(); # Get failure message.
}
...
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mailtokmahmed@gmail.com instead of using the issue tracker.

## Credits

- [Kazi Mainuddin Ahmed][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/tzsk/push.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/tzsk/push/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/tzsk/push.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/tzsk/push.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/tzsk/push.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/tzsk/push
[link-travis]: https://travis-ci.org/tzsk/push
[link-scrutinizer]: https://scrutinizer-ci.com/g/tzsk/push/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/tzsk/push
[link-downloads]: https://packagist.org/packages/tzsk/push
[link-author]: https://github.com/tzsk
[link-contributors]: ../../contributors