<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>@yield('title') | {{config('app.name')}}</title>

{!! style(mix('css/frontend.css')) !!}
</head>

<body class="@yield('css_class')">

@yield('content')

{!! script(mix('js/manifest.js')) !!}
{!! script(mix('js/vendor.js')) !!}
{!! script(mix('js/frontend.js')) !!}
<script src="https://www.gstatic.com/firebasejs/5.7.1/firebase.js"></script>
<script>
// Initialize Firebase
var config = {
    apiKey: "{{ config('services.firebase.api_key') }}",
    authDomain: "{{ config('services.firebase.auth_domain') }}",
    databaseURL: "{{ config('services.firebase.database_url') }}",
    storageBucket: "{{ config('services.firebase.storage_bucket') }}",
};
firebase.initializeApp(config);

var database = firebase.database();
</script>	
@yield('js')
</body>
</html>
