<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Supercategory;

class Category extends Model
{
    //
    protected $guarded =[];


    public function supercategory(){
        return $this->belongsTo(Supercategory::class);
    }


    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getImageAttribute($val){
        if (!$val){
            return '/storage/images/app/no-image.png';
        };
        return $val;
    }

    public function setNameAttribute($val)
    {
        $this->attributes['slug'] = '/'.str_slug($val);
        $this->attributes['name'] = ucfirst($val);
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
    
      public function getNameAttribute($name)
    {
        return ucfirst($name);
    }

}

