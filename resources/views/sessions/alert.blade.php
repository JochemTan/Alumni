@if(Session::has('alert'))
	
<script>
	swal("","{{ Session::get('alert') }}", "success")
</script>
@endif