<?php

namespace App\Nova\Cards;
use Illuminate\Http\Request;
use \Laravel\Nova\Http\Requests\NovaRequest;
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
    public $width = 'full';

    /**
     * The height strategy of the card (fixed or dynamic).
     */
    public $height = 'fixed';
    /**
     * Align content to the center of the card.
     */
    public bool $center = true;

    public function authorizedToSee(Request $request)
    {
        return auth()->user()->Authority >= 1;
    }
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
        $returner ='<h1>Last Updated at watchdog : '.$time.'</h1>
        <h2>Last Updated at rws_revison_history : '.$time2.'</h2>
        <div style="text-align: center;">';
          
      if(auth()->user()->Authority === 2){
        $returner=$returner.'<a style="text-align:center;" href="'.url("copy_rws").'">copy rws<br></a>
       <a style="text-align:center;" href="'.url("copy_watchdogs").'">Get watchdogs</a>
       </div>';
      }
      
        return $returner;
      
     }
}
