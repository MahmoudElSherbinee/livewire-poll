<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['title'];
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function votes()
    {
        return $this->hasManyThrough(Vote::class, Option::class);
    }
    public function totalVotes()
    {
        return $this->votes()->count();
    }
}
