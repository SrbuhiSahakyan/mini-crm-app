<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Customer; 

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = ['customer_id','subject','text','status','manager_replied_at'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}