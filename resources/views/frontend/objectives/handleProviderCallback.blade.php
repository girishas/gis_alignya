@extends('frontend/layouts/default')

@section('content')
 
    <main style="opacity:1;">
        
    </main>
	@if(Auth::check()){
		<script type="text/javascript">
			window.onunload = refreshParent;
			function refreshParent() {
				window.opener.location.reload();
			}
			window.close();
			window.opener.location.reload();
		</script>
	@else
		<script type="text/javascript">
			window.onunload = refreshParent;
			function refreshParent() {
				window.opener.location.reload();
			}
			window.close();
			window.opener.location.reload();
		</script>
	@endif
@stop