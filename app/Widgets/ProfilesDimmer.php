<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Widgets\BaseDimmer;

class ProfilesDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\Profile::count();
        $string = 'Профили пользователей';
        $string1 = 'Профиля пользователей';
        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-person',
            'title'  => "{$string}",
            'text'   => __('voyager::dimmer.page_text', ['count' => $count, 'string' => Str::lower($string1)]),
            'button' => [
                'text' => 'Перейти',
                'link' => route('voyager.profiles.index'),
            ],
            'image' => './images/widgets-bg/profiles-bg.jpg',
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
