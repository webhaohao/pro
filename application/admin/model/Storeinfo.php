<?php
namespace app\admin\model;
use think\Model;
class Storeinfo extends Model
{
    public function partinfo(){
        return $this->hasMany('partinfo','sid');
    }
    public function storeman(){
        return $this->belongsTo('storeman','storeid');
    }
}
