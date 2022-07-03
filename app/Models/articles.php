<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class articles extends Model
{
   use SoftDeletes;
    use HasFactory;
    protected $table= 'articles';
    public $timestamps= false;
    public function getCategory()
    {
      return   $this->hasOne('App\Models\categories','id','category_id');
    }
}
