<?php
namespace app\store\model;
use think\Model;
class Storeinfo extends Model
{
    public function partinfo(){
        return $this->hasMany('partinfo','sid');
    }
}
