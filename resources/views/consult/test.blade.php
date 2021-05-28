@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">

            </div>
            <div class="card-body">
                <p>
                    <a class="btn btn-primary" data-toggle="collapse" href="#t123456789" role="button" aria-expanded="false" aria-controls="t123456789">
                        Link with href
                    </a>
                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#1444bhguthrtg784545" aria-expanded="false" aria-controls="1444bhguthrtg784545">
                        Button with data-target
                    </button>
                </p>
                <div class="collapse" id="t123456789">
                    <div class="card card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

