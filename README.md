# Captcha for Lumen5

本項目修改 [Captcha for Laravel 5](https://github.com/mewebstudio/captcha) 和 [lumen-captcha](https://github.com/aishan/lumen-captcha) 加上了lumen 5.5 支持, 也修复了一些导致不能用的bug


## Preview
![Preview](http://i.imgur.com/HYtr744.png)

## Install
* 此 Package 必须开启 Cache 才能使用，应为验证码是保存在cache里面。

```
composer require tridiamond/captcha-lumen5
```


## How to use

在`bootstrap/app.php`中注册Captcha Service Provider：

```php
    $app->register(TriDiamond\CaptchaLumen5\CaptchaServiceProvider::class);
    class_alias('TriDiamond\CaptchaLumen5\Facades\Captcha','Captcha');
```


## Set

在`bootstrap/app.php`中可以設定各種自定義類型的驗證碼屬性，更多詳細設定請查看 [Captcha for Laravel 5](https://github.com/mewebstudio/captcha)
```php
    'characters' => '2346789abcdefghjmnpqrtuxyzABCDEFGHJMNPQRTUXYZ',

    'useful_time' => 5, //驗證碼有效時間（分鐘）

    'login'   => [ //驗證碼樣式
        'length'    => 4, //驗證碼字數
        'width'     => 100, //圖片寬度
        'height'    => 44, //字體大小和圖片高度
        'angle'     => 10, //字體傾斜度
        'lines'     => 2, //橫線數
        'quality'   => 90, //品質
        'invert'    =>false, //反相
        'bgImage'   =>true, //背景圖
        'bgColor'   =>'#ffffff',
        'fontColors'=>['#339900','#ff3300','#9966ff','#3333ff'],//字體顏色
    ],

    'flat'   => [
        'length'    => 6,
        'width'     => 160,
        'height'    => 46,
        'quality'   => 90,
        'lines'     => 6,
        'bgImage'   => false,
        'bgColor'   => '#ecf2f4',
        'fontColors'=> ['#2c3e50', '#c0392b', '#16a085', '#c0392b', '#8e44ad', '#303f9f', '#f57c00', '#795548'],
        'contrast'  => -5,
    ],

    'mini'   => [
        'length'    => 3,
        'width'     => 60,
        'height'    => 32,
    ],

    'inverse'   => [
        'length'    => 5,
        'width'     => 120,
        'height'    => 36,
        'quality'   => 90,
        'sensitive' => true,
        'angle'     => 12,
        'sharpen'   => 10,
        'blur'      => 2,
        'invert'    => true,
        'contrast'  => -5,
    ]
```
如果不配置設定檔，默認就是default，驗證碼有效時限為5分鐘。
## Example
因為 Lumen 都是無狀態的 API，所以驗證碼圖片都會綁上一個 UUID，先獲得驗證碼的 UUID 跟圖片的 URL，驗證時再一併發送驗證碼與 UUID。
### Generate
獲得驗證碼：
```
{Domain}/captchaInfo/{type?}
```
`type`就是在 config 中定義的 Type，如果不指定`type`，默認為`default`樣式，Response：
```json
{
  "captchaUrl": "http://{Domain}/api/captcha-image/login/782fdc90-3406-f2a9-9573-444ea3dc4d5c",
  "captchaUuid": "782fdc90-3406-f2a9-9573-444ea3dc4d5c"
}
```
`captchaUrl`為驗證碼圖片的 URL，`captchaUuid`為綁定驗證碼圖片的uuid。

#### validate
在發送 Request 時將驗證碼與 UUID 一併送回 Server 端，在接收參數時做驗證即可：
```php
public function checkCaptcha(Request $request, $type = 'default',$captchaUuid)
    {
        $this->validate($request,[
            'captcha'=>'required|captcha:'.$captchaUuid
        ]);
        ...
    }
```


## Links
* [Intervention Image](https://github.com/Intervention/image)
* [L5 Captcha on Github](https://github.com/mewebstudio/captcha)
* [L5 Captcha on Packagist](https://packagist.org/packages/mews/captcha)
* [For L4 on Github](https://github.com/mewebstudio/captcha/tree/master-l4)
* [License](http://www.opensource.org/licenses/mit-license.php)
* [Laravel website](http://laravel.com)
* [Laravel Turkiye website](http://www.laravel.gen.tr)
* [MeWebStudio website](http://www.mewebstudio.com)
