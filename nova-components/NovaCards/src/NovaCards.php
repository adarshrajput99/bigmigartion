<?php

namespace Stepanenko3\NovaCards;

use Illuminate\Http\Request;
use Laravel\Nova\Card;

class NovaCards extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-cards';
    }
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
