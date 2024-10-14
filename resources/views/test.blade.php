<!-- Display success message -->
@if ($message = Session::get('success'))
<div class="alert alert-success">
    {{ $message }}
</div>
@endif