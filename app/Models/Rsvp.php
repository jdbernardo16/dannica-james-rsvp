<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Rsvp extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_id',
        'attending_count',
        'message',
        'song_suggestion',
        'email',
        'submitted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'submitted_at' => 'datetime',
        'attending_count' => 'integer',
    ];

    /**
     * Get the group that owns the RSVP.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Get the formatted submitted date.
     */
    protected function submittedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->submitted_at ? $this->submitted_at->format('F j, Y \a\t g:i A') : ''
        );
    }

    /**
     * Get the formatted submitted date for display.
     */
    protected function submittedAtShort(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->submitted_at ? $this->submitted_at->format('M j, Y') : ''
        );
    }

    /**
     * Get the attendance status as a string.
     */
    protected function attendanceStatus(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attending_count > 0 ? 'Attending' : 'Not Attending'
        );
    }

    /**
     * Check if the group is attending.
     */
    public function isAttending(): bool
    {
        return $this->attending_count > 0;
    }

    /**
     * Get a truncated version of the message.
     */
    protected function messageExcerpt(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->message ? Str::limit($this->message, 100) : ''
        );
    }

    /**
     * Scope a query to only include attending RSVPs.
     */
    public function scopeAttending($query)
    {
        return $query->where('attending_count', '>', 0);
    }

    /**
     * Scope a query to only include non-attending RSVPs.
     */
    public function scopeNotAttending($query)
    {
        return $query->where('attending_count', '=', 0);
    }

    /**
     * Scope a query to order by submission date.
     */
    public function scopeLatestSubmitted($query)
    {
        return $query->orderBy('submitted_at', 'desc');
    }
}
