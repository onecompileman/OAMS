<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Facade;


class WebScrap extends Facade
{
    public $contents;
    public $playerUrl=[];
    function __construct($url)
    {
       $this->contents=file_get_contents($url);
    }
    public function filterToPlayer(){
        $tableOfPlayer=explode('<tr',explode('<tbody>',(explode('<table',$this->contents)[1]))[1]);
        unset($tableOfPlayer[0]);
        foreach($tableOfPlayer as $player)
            $this->playerUrl[] = substr($player,strpos($player,'href="')+6, strpos(substr($player,strpos($player,'href="')+4),'">')-2);
            return $this->playerUrl;
    }
}