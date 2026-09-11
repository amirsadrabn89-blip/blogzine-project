@extends('layouts.layout-master')


@push('styles')
    {{-- ... --}}
@endpush


@section('layout-content')
    @if (auth()->user()?->is_admin)
        @include('partials.admin-dashboard-header')
    @else
        @include('partials.user-dashboard-header')
    @endif



    <main>
        @yield('dashboard-content')
    </main>


    @include('partials.dashboard-footer')
@endsection


@push('scripts')
    {{-- ... --}}
@endpush
