<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;


class Supercategory extends Model
{
    protected $guarded = [];

    public function Categories(){
        return $this->hasMany(Category::class);
    }

     public function setNameAttribute($val)
    {
        $this->attributes['slug'] = '/'.str_slug($val);
        $this->attributes['name'] = ucfirst($val);
    }
   public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

     public function getSlugAttribute($val)
    {
        if (!$val)
        {
           $val = '/'.str_slug($this->name);
           $this->attributes['slug'] = $val;
           $this->save();
        }
        return $val;
    }
}
