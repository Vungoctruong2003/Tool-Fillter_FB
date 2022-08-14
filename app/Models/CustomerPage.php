<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPage extends Model
{
    use HasFactory;

    protected $table = 'customer_pages';

    protected $fillable = ['fb_user_id', 'page_code', 'fb_user_inbox_id', 'fb_send_time'];
}
