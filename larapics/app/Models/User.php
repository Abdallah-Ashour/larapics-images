<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profile_image',
        'cover_image',
        'country',
        'city',
        'about_me',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function getImageCount()
    {
        $imagesCount = $this->images()->published()->count();
        return $imagesCount . " images";
    }


    public function updateSettings($data){
        $this->updateSocialProfile($data['social']);
        $this->updateOpyions($data['options']);
        $this->update($data['user']);
    }
    protected function updateSocialProfile($social)
    {
        Social::updateOrCreate(
            ['user_id' => $this->id],
            $social
        );
    }

    protected function updateOpyions($options){
        $this->setting()->update($options);
    }


    public function profileImageUrl(){
        return  asset('storage/' . ($this->profile_image ? $this->profile_image : 'users/user-default.png'));

        // return Storage::url($this->profile_image ? $this->profile_image : 'users/user-default.png');
    }
    public function coverImageUrl(){
        return  asset('storage/' . ($this->cover_image));
        // return Storage::url($this->cover_image);
    }

    public function hasCoverImage(){
        return !is_null($this->cover_image);
    }
    public function url()
    {
        return route('author.show', $this->username);
    }
    public function inlineProfile(){
        // return "{{$this->name}}; • &nbsp; {{$this->country}} &nbsp; • &nbsp; Member since Oct. 28,
        // 2017 &nbsp; • &nbsp; 40
        // images";

        return collect([
            $this->name,
            trim(join('/', [$this->city, $this->country]), "/"),
            "Member since " . $this->created_at->toFormattedDateString(),
            $this->getImageCount()
        ])->filter()->implode(" • ");
    }

    public function social(){
        return $this->hasOne(Social::class)->withDefault();
    }


    public function setting(){
        return $this->hasOne(Setting::class)->withDefault();
    }

    public static function makeDirectory(){
        $directory = 'users';
        Storage::makeDirectory($directory);
        return $directory;
    }

    // protected function updateSocialProfile($social){
    //     Social::updateOrCreate(
    //         ['user_id', $this->id],
    //         $social
    //     );
    //     // if($this->social()->exists()){
    //     //     $this->social()->update($social);
    //     // }else{
    //     //     $this->social()->create($social);
    //     // }
    // }
   /*
    public function recentSocial(){
        return $this->hasOne(Social::class)->latestOfMany();
    }

    public function oldestSocial(){
        return $this->hasOne(Social::class)->oldestOfMany();
    }

    public function socialPriority(){
        return $this->hasOne(Social::class)->ofMany('priority', 'max');
    }
    */

    protected static function booted()
    {
        static::created(function ($user) {
            $user->setting()->create([
                "email_notification" => [
                    "new_comment" => 1,
                    "new_image" => 1
                ],
                // 'username' => 'abood'
            ]);
        });
    }

}// end of model
