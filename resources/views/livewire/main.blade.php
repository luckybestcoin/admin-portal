@extends('layouts.app')

@section('title', ' | '.$title)

@section('content')
@include('includes.top-navigation')
@include('includes.sidebar')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/"><span class="fa fa-home"></span> Dashboard</a></li>
                        @foreach ($breadcrumb as $key => $brd)
                        <li class="breadcrumb-item">
                            {{ $brd }}
                        </li>
                        @endforeach
                    </ol>
                </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>
    @yield('subcontent')
</div>
@endsection

