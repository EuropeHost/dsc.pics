<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Media;
use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use Notifiable, HasFactory, LogsActivity, CausesActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'role', 'locale'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => $eventName);
    }

    protected $fillable = [
        'name',
        'email',
        'discord_id',
        'avatar',
    ];

    protected $hidden = [
        'remember_token',
    ];
	
	protected $keyType = 'string';
	public $incrementing = false;
	
	protected static function boot()
	{
	    parent::boot();
	
	    static::creating(function ($model) {
	        if (empty($model->id)) {
	            $model->id = (string) Str::uuid();
	        }
	    });
	}
	
	public function media()
	{
	    return $this->hasMany(Media::class);
	}
	
	public function links()
	{
	    return $this->hasMany(Link::class);
	}
	
	public function getStorageUsedAttribute()
	{
	    return $this->media()->sum('size');
	}
	
	public function getStorageUsedMBAttribute()
	{
	    return round($this->storage_used / 1024 / 1024, 2);
	}
	
	/*
	public function getStorageLimitMBAttribute()
	{
	    return 250;
	}
	
	public function getStoragePercentageAttribute()
	{
	    return min(100, round(($this->storage_used / (250 * 1024 * 1024)) * 100, 2));
	}
	*/
	
	public function getStorageLimitMBAttribute()
	{
	    return 150;
	}
	
	public function getStoragePercentageAttribute()
	{
	    return min(100, round(($this->storage_used / (150 * 1024 * 1024)) * 100, 2));
	}
	
	/*public function storage_limit()
	{
		return $this->getStorageLimitMBAttribute;
	}*/
}
