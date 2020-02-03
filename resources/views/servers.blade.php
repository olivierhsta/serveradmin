@extends('layouts.master')

@section('content')
    <div class="content">
        <section class="hero is-small is-dark is-bold has-text-centered">
            <logout-button></logout-button>
            <div class="hero-body">
                <div class="container">
                    <h1 class="title is-size-1">
                        Server Admin
                    </h1>
                </div>
            </div>
        </section>
        <server-list></server-list>
    </div>
@endsection
