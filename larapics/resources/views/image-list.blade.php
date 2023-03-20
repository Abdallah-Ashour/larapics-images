<x-layouts title="Discovery free images">


    <div class="container-fluid mt-4">
        @if ($message = session('message'))
         <x-alert type="success" dismissible="true" >
            {{$component->icon()}}
            <x-slot name='message'>
            {{ $message }}
            </x-slot>
         </x-alert>
       @endif

       @include('shared._grid-images', ['images' => $images ])

    </div>

    {{-- <h1>All Images</h1>

    <a href="{{ route('image.create') }}">Upload Image</a>


    @if ($message = session('message'))
         <div>
            {{ $message }}
         </div>
    @endif
    @foreach ($images as $image)
    <div>
    <a href="{{ $image->permaLink() }}">
        <img src="{{ $image->fileUrl() }}" alt="{{ $image->title }}" style="margin: 10px" width="300">
    </a>

    <div style="margin-bottom: 20px">
        <a href="{{route('image.edit', $image->id)}}">Edit</a>

        <x-form action="{{route('image.destroy', $image->id)}}" method="delete" style="margin-left: 10px; display:inline">

            <button type="submit" onclick="confirm('Are You Sure?')">Delete</button>
        </x-form>



    </div>

    </div>
    @endforeach --}}

</x-layouts>
