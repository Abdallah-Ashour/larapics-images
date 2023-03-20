<x-layouts title="{{ $user->username }}" >

    <section class="jumbotron-author-image-background" style="background-image: @if($user->hasCoverImage()) url({{$user->coverImageUrl()}}); height:88vh; background-size:cover; @else background-image: url(images/cover-image.jpeg);@endif background-attachment: fixed;">
        <div class="jumbotron jumbotron-fluid py-4" @if($user->hasCoverImage()) style="height:88vh" @endif>
            <div class="container-fluid text-center">
                <h1 class="jumbotron-heading">{{ $user->username }}</h1>
                <p class="lead"> {{ $user->inlineProfile() }} </p>
                <img src="{{ $user->profileImageUrl() }}" class="rounded-circle" alt="..." width="150" height="150">
                <div class="mt-3">
                    <ul class="list-unstyled list-inline">
                        @if ($facebook = $user->social->facebook)
                        <li class="list-inline-item">
                            <a href="{{ $facebook }}" title="Facebook" target="_blank"><x-icon src="{{ 'facebook.svg' }}"/></a>
                        </li>
                        @endif
                        @if ($twitter = $user->social->twitter)

                        <li class="list-inline-item">
                            <a href="{{ $twitter }}" title="Twitter" target="_blank"><x-icon src="{{ 'twitter.svg' }}"/></a>
                        </li>
                        @endif

                        @if ($instagram = $user->social->instagram)

                        <li class="list-inline-item">
                            <a href="{{ $instagram }}" title="Instagram" target="_blank"><x-icon src="{{ 'instagram.svg' }}"/></a>
                        </li>
                        @endif

                        @if ($website = $user->social->website)

                        <li class="list-inline-item">
                            <a href="{{ $website }}" title="Website" target="_blank"><x-icon src="{{ 'website.svg' }}"/></a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <div class="container-fluid mt-5">
        @if ($images->count())

        @include('shared._grid-images', ['images' => $images])

        @else
        <x-alert type="warning" >
            <h4 class="alert-heading">Wow</h4>
            <p>That's a very clean portifolio</p>
        </x-alert>
        @endif
    </div>

</x-layouts>

