<?php

namespace CreatyDev\Domain;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $fillable=['title','name','description','gallery','category','slug','brand_id'];
}
