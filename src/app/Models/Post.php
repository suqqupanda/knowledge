<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'post',
    ];

    /**
     * 投稿を登録
     *
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $this->create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'post' => $data['post']
        ]);
    }
}
