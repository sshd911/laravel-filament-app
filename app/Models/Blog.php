<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'blogs';
    protected $guarded = [];
}