<?php

namespace App\Http\Controllers;
use App\Category;
use App\Supercategory;
use App\Product;
use App\Metadata;
use App\ProductImage;

use Illuminate\Http\Request;

class SupercategoryController extends Controller
{

    public function uploadImage(Request $request)
    {
        $supercategory = supercategory::find($request->id);
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $path = $file->storeAs('/images/supercategories',$supercategory->slug.'.'.$ext);
        $supercategory->image = '/storage/'.$path;
        $supercategory->save();
        return $supercategory;
    }


  

   


    public function getAll()
    {
        return supercategory::with('categories.products.images')->get();
    }

    public function update(Request $request)
    {
        $field = $request->field;
        $supercategory = supercategory::find($request->id);
        $supercategory->$field = $request->value;
        $supercategory->save();
        return $supercategory;
    }
}
