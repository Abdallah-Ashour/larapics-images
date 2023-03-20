<x-layouts title="Upload New images">

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Upload your photo</div>

                    <div class="card-body">

                        <x-form action="{{ route('image.store') }}" method="post" enctype="multipart/form-data">
                            <div class="mb-4">
                                <label class="form-label" for="file">Photo</label>
                                <input class="form-control @error('file') is-invalid @enderror" type="file" name="file" id="file">
                                @error('file')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @else
                                    <div class="form-text">
                                        You can only upload your photo in following types: jpg & png
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"  value="{{ old('title') }}">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                                @enderror
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label" for="title">Photo Tags</label>
                                <input type="text" class="form-control">
                                <div class="form-text">
                                    Separate your tags with comma
                                </div>
                            </div> --}}

                            <button type="submit" class="btn btn-primary">Upload</button>
                            <a href="{{ route('image.index') }}" class="btn btn-outline-secondary">Cancel</a>

                            </x-form>


                    </div>
                </div>

            </div>
        </div>
    </div>


</x-layouts>
