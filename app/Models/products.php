<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin;
use App\Models\orders;

class products extends Model
{
    use Notifiable;

    protected $table = 'products';

    protected $fillable = [
        'watershop_id','product_name','stock_qty'
        ,'item_size','item_size1','item_size2','item_size3'
        ,'new','refill','price','photo','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select('id','watershop_id','product_name','stock_qty'
            ,'item_size','item_size1','item_size2','item_size3'
            ,'new','refill','price','photo','created_at','updated_at'
        );
    }

    public function watershope(){
        return $this->belongsTo(Admin::class, 'watershop_id' ,'id'); 
    }

    public function orders(){
        return $this->hasMany(orders::class,'product_id','id');
    }
}
