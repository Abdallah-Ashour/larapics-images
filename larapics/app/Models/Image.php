<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function uplaodImage()
    {
        return $this->created_at->diffForHumans();
    }

    public static function makeDirectory(){
        $subFolder = 'image/' .  date('y/m/d');
        Storage::makeDirectory($subFolder);

        return $subFolder;
    }

    public static function getDimension($image){
        [$width, $height] = getimagesize(Storage::path($image));
        return $width . "X" . $height;
    }

    public function scopePublished($query){
        $query->where('is_published', true);
        return $query;
    }

    public function scopeVisibleFor($query, User $user){

        if($user->role === 'Admin' || $user->role === 'Editor'){
            return;
        }
        $query->where('user_id' ,$user->id);
        return $query;
    }

    public function fileUrl(){
        return asset('storage/' . $this->file);
    }

    public function permaLink(){
        return $this->slug ? route('image-show', $this->slug) : "#";
    }

    public function getSlug(){
        $slug = Str::slug($this->title);

        $numSlugsFound = static::where('slug', 'regexp', "^" . $slug . "(-[0-9])?")->count();
        if ($numSlugsFound > 0) {
            return $slug . "-" .$numSlugsFound + 1;
        }
        return $slug;

     }

     public function download(){
        return Storage::download($this->file);
     }

     protected static function booted(){

        static::creating(function($image){
            if($image->title){
                $image->slug = $image->getSlug();
                $image->is_published = true;
            }
        });

        static::updating(function($image){
            if($image->title && !$image->slug){
                $image->slug = $image->getSlug();
                $image->is_published = true;
            }
        });

        static::deleting(function($image){
           Storage::delete($image->file);
        });

     }

    protected $fillable = ['file', 'title', 'user_id', 'dimension', 'slug'];
} // end of image model
