@php
    function getAtive($route){
        return request()->routeIs($route.".*")?'active':'';
    }
@endphp
<header class="masthead mb-auto">
    <div class="inner">
        <h3 class="masthead-brand">Cover</h3>
        <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link {{getAtive('clients')}}" href="{{route('clients.home')}}">Cliente</a>
            <a class="nav-link {{getAtive('addresses')}}" href="{{route('addresses.home')}}">Endereço</a>
        </nav>
    </div>
</header>
