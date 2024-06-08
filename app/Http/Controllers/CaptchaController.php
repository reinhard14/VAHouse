<?php

namespace App\Http\Controllers;

use Mews\Captcha\Facades\Captcha;

class CaptchaController extends Controller
{
    public function getCaptcha()
    {
        return Captcha::create('default');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha' => captcha_img('default')]);
    }
}
