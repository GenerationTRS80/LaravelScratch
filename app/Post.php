<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
    //Change table Name 
    protected $table = 'posts';

    // Change Primary key field
    public $primaryKey = 'posts_key';

    // Add Timestamps
    public $timestamp = true;

    // Add relationship ( One) to Model User
    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
