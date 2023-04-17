<?php

namespace App\Nova\Cards;

use Abordage\HtmlCard\HtmlCard;
use App\Http\Controllers\copy;
use App\Models\watchdog;
use Illuminate\Support\Facades\DB;
class MyHtmlCard extends HtmlCard
{
    /**
     * Name of the card (optional, remove if not needed)
     */
    

    /**
     * The width of the card (1/2, 1/3, 1/4 or full).
     */
    public $width = '1/3';

    /**
     * The height strategy of the card (fixed or dynamic).
     */
    public $height = 'fixed';
    /**
     * Align content to the center of the card.
     */
    public bool $center = true;

    /**
     * Html content
     */
    function time_max(){
      //watchdog
      $lastInsertTime = DB::table('watchdogs')->where('rhid', 0)->max('timestamp');
      $time_int = strtotime($lastInsertTime);
      //$timestamp = time($time_int);

      //$lastInsertTime = DB::connection('mysql')->table('watchdogs')->smax('updated_at');
      return date("d-m-y h:i:sa",$lastInsertTime);
      }
      function time_max_rws(){
      //rws_revison_history
      $maxValue = DB::table('watchdogs')->where('wid', NULL)->max('created');
      $time_int = strtotime($maxValue);
      //$timestamp = time($time_int);

        //$lastInsertTime = DB::connection('mysql')->table('watchdogs')->smax('updated_at');
        return date("d-m-y h:i:sa",$maxValue);
        }   
    public function content(): string
     {
         $time=$this->time_max();
         $time2=$this->time_max_rws();
        return '<p>Last Updated at watchdog : <br> '.$time.'</p><p>Last Updated at rws_revison_history : <br>'.$time2.'</p>';
     }
}
