<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}">
</head>
<body>

  <div id="app"></div>

  @php
    $config = [
      'appName' => config('app.name'),
      'locale' => $locale = app()->getLocale(),
      'locales' => config('app.locales'),
      'githubAuth' => config('services.github.client_id'),
      'authID' => Auth::check()?Auth::id():0
    ];
  @endphp

  {{-- Global configuration object --}}
  <script>
<<<<<<< HEAD
    window.config = @json($config);    
    console.log(window.config.authID);    
=======
    window.config = @json($config);       
>>>>>>> modemb/dev
  </script>

  {{-- Load the application scripts --}}
  <script src="{{ mix('dist/js/app.js') }}"></script>
</body>
</html>
