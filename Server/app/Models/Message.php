<?php

namespace App\Models;

use App\Casts\DateTimeJalaliAndGregorianCast;
use App\Scopes\MessageScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Message extends BaseModel
{
    protected $perPage = 60;

    protected $fillable = [
        'message',
        'recipient_id'
    ];

    protected $appends = [
        'is_self_message',
        'seen_status'
    ];

    protected $casts = [
        'seen_at' => DateTimeJalaliAndGregorianCast::class
    ];

    /**
     * Is it my message or not
     * @return bool
     */
    public function getIsSelfMessageAttribute()
    {
        return $this->sender_id === auth()->id();
    }

    /**
     * @return bool
     */
    public function getSeenStatusAttribute()
    {
        return ! is_null($this->getRawOriginal('seen_at'));
    }

    /**
     * @return string
     */
    protected function generateMessageId()
    {
        return Str::random(60);
    }

    public function save(array $options = [])
    {
        if (! $this->message_id)
            $this->message_id = $this->generateMessageId();

        return parent::save($options);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope(new MessageScope());
    }

    public function scopeConversation(Builder $builder, $user1, $user2)
    {
        return $builder->where(function(Builder $builder) use($user1, $user2) {
            $builder->where('sender_id', $user1)
                ->where('recipient_id', $user2);
        })->orWhere(function(Builder $builder) use($user1, $user2) {
            $builder->where('recipient_id', $user1)
                ->where('sender_id', $user2);
        });
    }
}
