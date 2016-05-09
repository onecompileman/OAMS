<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Facade;

class playerStatsScrap extends Facade
{
    //
    public $playerUrl;
    public $allPlayerStats;
    function __construct(WebScrap $webScrap)
    {
       $this->playerUrl=$webScrap->filterToPlayer();
    }
    protected function getPlayerData($index){
        $fieldNames=['date','team','Opp','worl','GS','mp','pts','fgm','fga','fg','3pm','3pa','3p','ftm','fta','ft','offReb','dReb','tReb','ast','stl','blk','tov','pf'];
        $contents =file_get_contents("http://stats.humblebola.com".$this->playerUrl[$index].'/game_log');

        $contents=substr(substr($contents,strpos($contents,'<table class="stat-table table table-striped table-hover sortable">'),strpos($contents,"</table>")-strpos($contents,'<table class="stat-table table table-striped table-hover sortable">')),strpos($contents,strpos($contents,"<tbody>")),strpos($contents,'</tbody>'));
        $stats=[];
       /* dd($contents);*/

        $row = explode('<tr',$contents);

        for($ndx =2;$ndx < count($row); $ndx++){
             $col=explode('<td',$row[$ndx]);
                for($ndx2 =1; $ndx2 < count($col); $ndx2++)
                    $stats[$ndx - 5][$fieldNames[$ndx2 - 1]] =(strpos($col[$ndx2],'">'))? substr($col[$ndx2], strpos($col[$ndx2 - 1], '">') + 1, strpos($col[$ndx2 - 1], '</')) : substr($col[$ndx2], strpos($col[$ndx2 - 1], '>') + 1, strpos($col[$ndx2 - 1], '</'));

                }
        return $stats;
    }
    public function getPerPlayerData(){

       for($ndx =0; $ndx < count($this->playerUrl); $ndx++) {

           $this->allPlayerStats[$ndx]['playerName'] = explode('-', $this->playerUrl[$ndx])[1] . " " . explode('-', $this->playerUrl[$ndx])[2];
            $this->allPlayerStats[$ndx]['data']=$this->getPlayerData($ndx);

       }
        return $this->allPlayerStats;
    }
    protected static function getFacadeAccessor()
    {
        return 'playerStatsScrap';
    }

}
