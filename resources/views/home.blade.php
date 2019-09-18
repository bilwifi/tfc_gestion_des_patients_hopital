@extends('layouts.master')
@push('stylesheets')
<style type="text/css">
.table td, .table th{
            border-top: 0px;
    }
</style>
@endpush

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-transparent">
                <div class="card-header">
                    {{ $service->lib }}
                    
                </div>

                <div class="card-body" style="position: relative;overflow-y: scroll; max-height: 500px">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                    <div id="html_content">
                        @include('_affiche_patients')
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        jQuery(function($){
            setInterval(getPage,2000,'{{ route('home') }}');
            
            
        });
        
    </script>

@endpush
