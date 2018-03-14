# Screenshotlayer

Wrapper class for Screenshotlayer.com

## Installation

Clone the repository ```https://github.com/grinderspro/screenshotlayer.git```

Then run ```composer install```

## Usage

Получим скриншот сайта google.com и сохраним его локально на диск '/tmp/google.png'

```php
(new Screenshotlayer('your_secret_key'))
    ->options(['viewport' => '1440x900'])
    ->url('https://google.com')
    ->save('/tmp/google.png');
```

Получим ссылку полную ссылку на скиншот от сервиса Screenshotlayer, которую затем можно применить, например вставив в атрибут **src** тега **img**.

```php
$url = (new Screenshotlayer('your_secret_key'))
        ->options(['viewport' => '1440x900'])
        ->url('https://google.com')
        ->stringUrl();
```

```php
<img src="<?=$url?>" alt="Image title"> 
```