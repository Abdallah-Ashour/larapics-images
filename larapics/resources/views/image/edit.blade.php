<x-layouts title="Upadte Image">

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">Upadte Image</div>

                    <div class="card-body">

                        <x-form action="{{ route('image.update', $image->id) }}" method="put">
                            <div class="mb-4">
                                <img src="{{ $image->fileUrl() }}" alt="{{ $image->title }}" class="img-fluid">
                            </div>

                            <div class="mb-4">
                                <label class="form-label" for="title">Title</label>
                                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title"  value="{{ old('title', $image->title) }}">
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

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('image.index') }}" class="btn btn-outline-secondary">Cancel</a>

                            </x-form>


                    </div>
                </div>

            </div>
        </div>
    </div>


</x-layouts>
