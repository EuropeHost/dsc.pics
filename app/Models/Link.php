<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Link extends Model
{
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['original_url', 'slug'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "This link has been {$eventName}");
    }

    protected $fillable = [
        'user_id', 'original_url', 'slug', 'visits',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }

            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug();
            }
        });
    }

    protected static function generateUniqueSlug()
    {
        do {
            $slug = Str::random(7);
        } while (self::where('slug', $slug)->exists());
        return $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function views()
    {
        return $this->hasMany(LinkView::class);
    }
}
