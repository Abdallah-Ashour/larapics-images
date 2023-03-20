<?php

namespace App\Http\Requests;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ImageRequest extends FormRequest
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
        if($this->method() === 'PUT'){

            return [
                'title' => 'required'
            ];

    }
        return [
            'file' => 'required|image',
            'title' => 'nullable'
        ];

    }

    public function getData(){
        $data = $this->validated() + [
            'user_id' =>  $this->user()->id
        ];

        if($this->hasFile('file')){
            $directory = Image::makeDirectory();
            $data['file'] = $this->file->store($directory);
            $data['dimension'] = Image::getDimension($data['file']);
        } // end of if



        return $data;
    } //  end of function getData()

    /*
    protected function getSlug($title){
        $slug = Str::slug($title) . "-" .time();

        return $slug;

    //     $numberOfSlug = Image::where('slug', "regexp", "^" .$slug . "(-[0-9])?")->count;

    //     if($numberOfSlug > 0){
    //         return $slug . "-" . ($numberOfSlug + 1);
    //     }

    //     return $slug;
     }
*/
} //  end of class
