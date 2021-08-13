<?php


namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class MessageScope implements Scope
{

    public function apply(Builder $builder, Model $model)
    {
        $builder->where(function(Builder $builder){
            $builder->where('sender_id', Auth::id())
                ->orWhere('recipient_id', Auth::id());
        });
    }
}
