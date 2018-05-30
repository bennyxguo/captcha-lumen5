<?php

namespace TriDiamond\CaptchaLumen5;

use Yangbx\CaptchaLumen\Captcha;
use Illuminate\Support\ServiceProvider;

/**
 * Class CaptchaServiceProvider
 * @package Mews\Captcha
 */
class CaptchaServiceProvider extends ServiceProvider {

    /**
     * Boot the service provider.
     *
     * @return null
     */
    public function boot()
    {
        // Publish configuration files
        $this->publishes([
            __DIR__.'/../config/lumen-captcha.php' => config_path('lumen-captcha.php')
        ], 'config');

        // HTTP routing
        $this->app->get('/api/captcha[/{type}]', 'TriDiamond\CaptchaLumen5\LumenCaptchaController@getCaptchaInfo');
        $this->app->get('/api/captcha-image/{type}/{captchaId}', 'TriDiamond\CaptchaLumen5\LumenCaptchaController@getCaptcha');

        // Validator extensions
        $this->app['validator']->extend('captcha', function($attribute, $value, $parameters)
        {
            $captchaId=$parameters[0];
            return app('captcha')->checkCaptchaById($value,$captchaId);
        });

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__.'/../config/lumen-captcha.php', 'lumen-captcha'
        );

        // Bind captcha
        $this->app->bind('captcha', function($app)
        {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }

}
