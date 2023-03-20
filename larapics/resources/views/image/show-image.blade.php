<x-layouts title="{{ $image->title }}">

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-9">
            <div class="image-container">
                <img src="{{ $image->fileUrl() }}" title="{{ $image->title }}" class="img-fluid" />
            </div>

            {{-- related images  --}}
           {{-- @include('image._related-images') --}}

           {{-- comments --}}
           {{-- @include('image._comments') --}}
        </div>
        <div class="col-md-3">
            <div class="d-flex align-items-center mb-3">
                <img src="{{$image->user->profileImageUrl()}}"
                    alt="Author" class="rounded-circle mr-3" width="60">
                <div class="ms-3">
                    <h5><a href="{{ $image->user->url() }}" class="text-decoration-none">{{ $image->user->name }}</a></h5>
                    <p class="text-muted mb-0">{{ $image->user->getImageCount() }}</p>
                </div>
            </div>

            <div class="d-flex justify-content-between py-3 border-top border-bottom">

                <div>
                    <button type="button" title="Like mage" class="btn btn-primary">
                        <x-icon src="thumbs-up.svg" alt="" class="align-text-top" width="18" height="18"/> 150
                    </button>

                    <button type="button" title="Favorite mage" class="btn btn-danger">
                        <x-icon src="heart.svg" alt="" width="18" height="18"/>
                    </button>
                </div>

                <button title="Download" class="btn btn-success d-flex align-items-center">
                    <x-icon src="download.svg" alt="" class="align-text-top" width="18" height="18"/>
                    <span class="display-block ms-2"><a href="{{ route('download.image', $image->file) }}" target="_blank" download="lcqrWqkEXeZowFsbwrDYg7ojwGCXLHJk3VfJWhhK.jpg">Download</a></span>
                </button>
            </div>

            <div class="bg-light mt-3 p-3 border">
                <table width="100%">
                    <tbody>
                        <tr>
                            <th>Uploaded</th>
                            <td>{{ $image->uplaodImage() }}</td>
                        </tr>
                        <tr>
                            <th>Dimensions</th>
                            <td>{{ $image->dimension }}</td>
                        </tr>
                        <tr>
                            <th>Views</th>
                            <td>{{ $image->views_count }}</td>
                        </tr>
                        <tr>
                            <th>Downloads</th>
                            <td>{{ $image->download_count }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- <div class="tagcloud mt-3">
                <ul>
                    <li><a href="#">Nature</a></li>
                    <li><a href="#">Mountain</a></li>
                    <li><a href="#">Blue</a></li>
                    <li><a href="#">Forest</a></li>
                    <li><a href="#">Animal</a></li>
                </ul>
            </div> --}}
        </div>
    </div>


</div>


</x-layouts>
