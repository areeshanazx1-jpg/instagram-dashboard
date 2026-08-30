<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InstagramAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_label',
        'username',
        'access_token',
        'status',
        'last_sync_at',
    ];

    protected $casts = [
        'last_sync_at' => 'datetime',
    ];

    public function actionLogs(): HasMany
    {
        return $this->hasMany(ActionLog::class);
    }

    public function setAccessTokenAttribute($value)
    {
        $this->attributes['access_token'] = encrypt($value);
    }

    public function getAccessTokenAttribute($value)
    {
        return decrypt($value);
    }
}