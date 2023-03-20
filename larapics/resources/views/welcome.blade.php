<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>componen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>

   @php
       $src = 'download.svg';
   @endphp
    {{-- <x-icon :src="$src" /> --}}
    {{-- <x-icon src='download.svg' /> --}}
    <x-alert  type="success" dismissible="true" class="mx-auto m-5 ">
{{--
    <x-slot name="title">
       Success
   </x-slot> --}}
   {{ $component->icon('icons/heart.svg') }}
     <p class="mb-0">Data has been remove {{ $component->link('undo', 'google.com')}}</p>
    </x-alert>

    <x-form action="#" method="put">
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </x-form>


    {{-- <br>
    <x-ui.button /> --}}
</body>
</html>
