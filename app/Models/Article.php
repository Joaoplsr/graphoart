<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use App\Enum\RoleEnum;
use App\Enum\StatusEnum;
use App\Models\Category;
use App\Models\Status;
use App\Models\User;


class Article extends Model
{

    protected $fillable = [
        'title',
        'body',
        'author',
        'status_id',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function scopeUser(Builder $query):void
    {
        $user = Auth::user();
        

        if ($user->role_id === RoleEnum::ADMIN->value) {
            return;
        }
        if ($user->role_id === RoleEnum::EDITOR->value) {
            $query->where('user_id', $user->id);
            return;
        }
        if ($user->role_id === RoleEnum::REVIEWER->value) {
            $query->where('status_id', StatusEnum::IN_REVIEW->value);
            return;
        }
        
        $query->whereRaw('0 = 1');
    }
}
