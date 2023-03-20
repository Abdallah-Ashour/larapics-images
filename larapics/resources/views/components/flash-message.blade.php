@if ($message = session('message'))
         <x-alert type="success" dismissible="true" >
            {{$component->icon()}}
            <x-slot name='message'>
            {{ $message }}
            </x-slot>
         </x-alert>
       @endif
