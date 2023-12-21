<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'page_action_link',
        'page_hero_image',
        'author',
        'is_cached',
    ];
}
