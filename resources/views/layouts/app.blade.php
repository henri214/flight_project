@include('layouts.partials.header')

<body class="">
    @include('layouts.partials.navbar')
    @include('layouts.partials.aside')
    @yield('styles')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('scripts')
    {{-- @yield('stripeScripts') --}}
</body>

</html>
