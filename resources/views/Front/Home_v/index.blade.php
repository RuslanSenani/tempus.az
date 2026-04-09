<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('Front.includes.head')
</head>
<body data-offset="200" data-spy="scroll" data-target=".ow-navigation">

{{--@include('Front.includes.loader')--}}

<a id="top"></a>

<!-- Main Container -->
<div class="main-container">
    <!-- Header -->

    @include('Front.includes.header')


    @include('Front.Home_v.container')

    @include('Front.includes.footer')

</div>

<!-- Main Container -->

@include('Front.includes.js')

</body>

</html>
