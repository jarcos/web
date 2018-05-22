@extends('layouts.base')

@section('content')
<div class="shelters-header"></div>

<div id="shelters" class="shelters">
    <div class="container">

        <h2>Asociaciones que usan ProteCMS</h2>

        <p class="description col-12 col-md-8 ml-auto mr-auto text-center">Aquí aparecen las asociaciones que usan actualmente el proyecto. <br>Si haces clic en el logo podrás visitarlas. Hay más protectoras en el proyecto, pero solo aparecen las más activas.</p>

        <div class="card-columns">
            @foreach (DB::table('shelters')
                ->where('updated_at', '>', now()->subMonth(5))
                ->where('id', '!=', 12)
                ->whereNotNull('logo')
                ->whereNotNull('name')
                ->orderByDesc('updated_at')
                ->get(['id', 'name', 'domain', 'subdomain', 'logo']) as $shelter)
                <div class="card text-center">
                    <a href="http://{{ $shelter->domain or $shelter->subdomain.'.protecms.com' }}">
                        <div style="background-image:url(http://{{ $shelter->domain or $shelter->subdomain.'.protecms.com' }}/static/{{ $shelter->id }}/images/{{ $shelter->logo }})" class="logo"></div>
                        <p>{{ $shelter->name }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection