<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'max_attendees',
    ];

    /**
     * Get the guests for the group.
     */
    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }

    /**
     * Get the RSVPs for the group.
     */
    public function rsvps(): HasMany
    {
        return $this->hasMany(Rsvp::class);
    }

    /**
     * Get the latest RSVP for the group.
     */
    public function latestRsvp()
    {
        return $this->rsvps()->latest()->first();
    }

    /**
     * Get the total number of guests in the group.
     */
    public function getGuestCountAttribute(): int
    {
        return $this->guests()->count();
    }

    /**
     * Get the number of attendees based on the latest RSVP.
     */
    public function getAttendingCountAttribute(): int
    {
        $latestRsvp = $this->latestRsvp();
        return $latestRsvp ? $latestRsvp->attending_count : 0;
    }

    /**
     * Check if the group has RSVP'd.
     */
    public function hasRsvp(): bool
    {
        return $this->rsvps()->exists();
    }

    /**
     * Check if the group is attending based on latest RSVP.
     */
    public function isAttending(): bool
    {
        $latestRsvp = $this->latestRsvp();
        return $latestRsvp ? $latestRsvp->attending_count > 0 : false;
    }
}
