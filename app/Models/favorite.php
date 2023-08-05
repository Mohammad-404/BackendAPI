<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Admin;

class favorite extends Model
{
    use Notifiable;
    protected $table = 'favorite';

    
    protected $fillable = [
        'customer_id','watershop_id','created_at','updated_at'
    ];

    public function scopeSelection($query){
        return $query->select(
            'id','customer_id','watershop_id','created_at','updated_at'
        );
    }

    public function watershop(){
        return $this->hasMany(Admin::class,'watershop_id','id');
    }

}
