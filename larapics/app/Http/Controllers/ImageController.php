<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
      $this->authorizeResource(Image::class);
    }
    public function index(){
        $images = Image::visibleFor(request()->user())->latest()->paginate(15)->withQueryString();

        return view('image.index', compact("images"));
    }

    public function create(){
        return view('image.create');
    }

    public function store(ImageRequest $request){
        // $uploadImage = $request->input('file');
        // $filename = $uploadImage->store('image');
        Image::create($request->getData());
        return redirect()->route('image.index')->with('message', "Image has been uploaded Successfully!");
    }

    // public function show(Image $image){

    //     return view('image.show', compact('image'));

    // }

    public function edit(Image $image){

        // Gate::authorize('update-image', $image);
        $this->authorize('update', $image);

        // if(!Gate::allows('update-image', $image))
            // abort(403, "Don't Access To This Page");

        return view('image.edit', compact("image"));

    }

    public function update(ImageRequest $request, Image $image){
        $image->update($request->getData());
        return redirect()->route('image.index')->with('message', "Image has been updated Successfully!");
    }

    public function destroy(Image $image){

        if(Gate::denies('delete', $image))
            abort(403, "Don't Access To This Page");

        $image->delete();
        return redirect()->route('image.index')->with('message', "Image has been Removed Successfully!");

    }

}// end of the image controller
