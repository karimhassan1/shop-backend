<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Nodesol\LaraQL\Attributes\Model as AttributesModel;

#[AttributesModel(
    input_override:[
        'photo'=>'Upload! @upload(disk:"public",public:true)'
    ],
)]
class Product extends Model
{
    //

    protected $fillable = [
        'name',
        'description',
        'price',
        'inventory',
        'photo'
    ];
    
}