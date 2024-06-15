@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Penggajian') }}</div>
                <div class="card-body">
                    {{ __('You are in penggajian!') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module"></script>
@endpush
