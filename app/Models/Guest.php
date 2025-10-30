<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'full_name',
        'email',
    ];

    /**
     * Get the group that owns the guest.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the guest's first name.
     */
    public function getFirstNameAttribute(): string
    {
        return explode(' ', $this->full_name)[0];
    }

    /**
     * Get the guest's last name.
     */
    public function getLastNameAttribute(): string
    {
        $parts = explode(' ', $this->full_name);
        return count($parts) > 1 ? end($parts) : '';
    }

    /**
     * Scope a query to only include guests with email.
     */
    public function scopeWithEmail($query)
    {
        return $query->whereNotNull('email')->where('email', '!=', '');
    }

    /**
     * Check if the guest has an email address.
     */
    public function hasEmail(): bool
    {
        return !empty($this->email);
    }
}
