<?php

namespace App\Nova;

//namespace App\Nova\Cards;

use Illuminate\Http\Request;

use Laravel\Nova\Card;

class asrcard extends card
{
    public $width = '1/3';

    public function component()
    {
        return 'resources\js\components\cards';
    }

    /**
     * Get the card's content.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function content(Request $request)
    {
        $quotes = [
            'The best way to predict the future is to create it. - Abraham Lincoln',
            'Success is not final, failure is not fatal: it is the courage to continue that counts. - Winston Churchill',
            'Believe you can and you\'re halfway there. - Theodore Roosevelt',
        ];

        $quote = $quotes[array_rand($quotes)];

        return "<h1>{$quote}</h1>";
    }

}
