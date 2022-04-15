<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subject';
    /**
     * The table fillable property with the model.
     *
     * @var array
     */
    protected $fillable = ['title','chapter'];

}
