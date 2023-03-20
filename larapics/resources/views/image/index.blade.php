<x-layouts title="Discovery free images">


    <section class="py-3 border-bottom bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <a href="{{ route('image.create') }}" class="btn btn-primary">
                        <x-icon src="upload.svg" alt="Upload" class="me-2" />
                        <span>Upload</span>
                    </a>
                </div>
                <div class="col"></div>
                <div class="col text-right">
                    <form class="search-form">
                        <input type="search" name="q" placeholder="Search..." aria-label="Search..." autocomplete="off">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-4">
        <x-flash-message />

        <div class="row" data-masonry='{"percentPosition": true }'>

            @foreach ($images as $image)
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card">
                    <a href="{{ $image->permaLink() }}"><img src="{{ $image->fileUrl() }}" height="100%" alt="{{ $image->title }}"
                            class="card-img-top"></a>
                            {{-- @if (Auth::check() && Auth::user()->can('update', $image)) --}}
                            @canany(['update', 'delete'], $image)
                            <div class="photo-buttons">
                                @can('update', $image)
                                <a href="{{route('image.edit', $image->id)}}" class="btn btn-sm btn-info me-2">Edit</a>
                                @endcan

                                @can('delete', $image)
                                    <x-form action="{{route('image.destroy', $image->id)}}" method="delete" >

                                        <button class="btn btn-sm btn-danger" type="submit" onclick="confirm('Are You Sure?')">Delete</button>
                                    </x-form>

                                @endcan

                            </div>
                            @endcan
                            {{-- @endif --}}
                </div>
            </div>
            @endforeach

        </div>

        {{ $images->links()}}
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
