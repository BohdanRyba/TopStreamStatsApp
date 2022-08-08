<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'user_login',
        'user_name',
        'game_id',
        'game_name',
        'type',
        'title',
        'viewer_count',
        'started_at',
        'language',
        'thumbnail_url',
        'is_mature',
    ];
}
