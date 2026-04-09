<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('Front.includes.head')
    @stack('css')
</head>
<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">

<a id="top"></a>

<div class="main-container">
    @include('Front.includes.header')

    {{-- Bura hər səhifənin öz məzmunu gələcək --}}
    @yield('content')

    @include('Front.includes.footer')
</div>

@include('Front.includes.js')
@stack('js')
</body>
</html>

