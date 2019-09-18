@extends('layouts.master')
@push('stylesheets')

@endpush
@section('content')
<div id="html_content">
	@include('_affiche_patients_public')
</div>

@endsection
@push('scripts')
    <script type="text/javascript">
        jQuery(function($){
            setInterval(getPage,2000,'{{ route('affiche') }}');
        });

        setInterval(function() {
                $('.en_cours').fadeOut(500);
            }, 1000);
            setInterval(function() {
                $('.en_cours').fadeIn(1000);
            }, 1000);
        
    </script>
    
@endpush