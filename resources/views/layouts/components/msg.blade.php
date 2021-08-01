@if (session('success'))
<div class="alert alert-success alert-dismissable">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{session('success')}}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissable">
<button type="button" class="close" data-dismiss="alert">&times;</button>
{{session('error')}}
</div>
@endif