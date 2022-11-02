<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $appends = ['photo'];

    //Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopePending($query)
    {
        return $query->where('admin_check', 0);
    }

    public function scopeApproved($query)
    {
        return $query->where('admin_check', 1);
    }

    public function scopeRejected($query)
    {
        return $query->where('admin_check', 2);
    }

    public function scopeTrending($query)
    {
        return $query->where('trending', 1);
    }

    public function scopeMust_read($query)
    {
        return $query->where('must_read', 1);
    }

    public function scopeVideo($query)
    {
        return $query->where('have_video', 1);
    }

    public function getPhotoAttribute(){
        return getImage(imagePath()['news']['path'].'/'.$this->image,imagePath()['news']['size']);
    }

    //Relations
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
