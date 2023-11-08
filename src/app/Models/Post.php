<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Pagination\LengthAwarePaginator;
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
     * usersテーブルとtweetsテーブルのリレーションを貼る
     *
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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

    /**
     * 全投稿を取得
     *
     * @return LengthAwarePaginator
     */
    public function getAllPosts(): LengthAwarePaginator
    {
        return $this->orderBy("created_at", "desc")->paginate(config('const.ITEM_PER_PAGE'));
    }

    /**
     * 特定の投稿の情報を取得
     *
     * @param integer $postId
     * @return Post|null
     */
    public function getPostById(int $postId): Post|null
    {
        return Post::find($postId);
    }
}
