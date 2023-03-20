<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'social.*' => 'nullable|url',
            'options.disable_comments' => 'boolean',
            'options.moderate_comments' => 'boolean',
            'options.email_notification.*' => 'nullable',

            'user.username' => 'required|max:30|unique:users,username,' . Auth::id(),
            'user.name' => 'required|string',
            'user.profile_image' => 'nullable|image',
            'user.cover_image' => 'nullable|image',
            'user.city'  => 'nullable|string',
            'user.country'  => 'nullable|string',
            'user.about_me'  => 'nullable|text',

            'account.email' => 'required|email|unique:users,email,' . Auth::id() ,
            // 'account.password' => [
            //     Rule::requiredIf(
            //         $this->account['email'] !== auth()->user()->email || !empty($this->account['new_password']),
            //         function ($attribute, $value, $fail) {
            //             if (!empty($value) && Hash::check($value, auth()->user()->password)) {

            //                 $fail("The password is incorrect");
            //             }
            //         }
            //     )
            // ],
            // 'account.new_password' => 'confirmed'

        ];
    }
    public function attributes()
    {
        return [
            'social.facebook' => 'facebook',
            'social.instagram' => 'instagram',
            'social.twitter' => 'twitter',
            'social.website' => 'website',
            'user.username' => 'username',
            'user.name' => 'name',
            'user.profile_image' => 'profile image',
            'user.cover_image' => 'cover image',
            'user.city'  => 'city',
            'user.country'  => 'country',
            'user.about_me'  => 'about me',
            'account.email' => 'email',
            'account.password' => 'current password',
            'account.new_password' => 'new password',

        ];
    }

    public function getData()
    {
        $data = $this->validated();
        $directory = User::makeDirectory();
        $directory = $directory . "/user-" . Auth::id();

        if($this->hasFile('user.profile_image')){
           $data['user']['profile_image'] = $this->file('user.profile_image')->store($directory);
        }
        if($this->hasFile('user.cover_image')){
            $data['user']['cover_image'] = $this->file('user.cover_image')->store($directory);
         }

          if (!empty($data['account']['password'])) {
            $data['user']['email'] = $data['account']['email'];
        }

        if (!empty($data['account']['new_password'])) {
            $data['user']['password'] = Hash::make($data['account']['new_password']);
        }

        unset($data['account']);


        return $data;
    }
}
