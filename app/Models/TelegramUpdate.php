<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TelegramUpdate extends Model
{
    use HasFactory;

    /** @inheritdoc */
    protected $guarded = ['id'];

    /** @inheritdoc */
    protected $casts = [
        'message' => 'json',
    ];

    /** @inheritdoc */
    protected $appends = [
        'chat_id', 'command', 'isCommand'
    ];

    /**
     * @return int
     */
    public function getChatIdAttribute(): int
    {
        return $this->message['from']['id'];
    }

    /**
     * @return string
     */
    public function getCommandAttribute(): string
    {
        return $this->message['text'];
    }

    /**
     * @return bool
     */
    public function getIsCommandAttribute(): bool
    {
        return $this->message['entities'][0]['type'] === 'bot_command';
    }

    public function scopeIsCommand(Builder $query): void
    {
        $query->whereJsonContains('message->entities', ['type' => 'bot_command']);
    }

    public function scopeIsStart(Builder $query)
    {
        $query->where(DB::raw("json_search('message','all','/start%', null, '$.text')"));
    }
}
