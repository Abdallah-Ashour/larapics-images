<div {{ $attributes->merge(['class' => "{$getClasses}", 'role' => $attributes->prepends('alert')])}}>

    @isset($title)
      <h1 class="alert-heading">{{ $title }}</h1>
    @endisset


     {{ $slot }}
     @if ($dismissible)
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     @endif

     @isset($message)
       {{ $message }}
     @endisset

</div>
