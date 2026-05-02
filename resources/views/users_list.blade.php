@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Users List</h1>
    <div id="user-table">
        @include('partials.user_table')
    </div>
    @role('admin')
        <a class="btn btn-secondary mt-3" href="{{ route('admin.dashboard') }}">Back</a>
    @endrole
</div>


@push('scripts')
<script>
$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();

   let url = $(this).attr('href'); 

    $.ajax({
        url: url,
        type: "GET",
        beforeSend: function() {
            $('#user-table').css('opacity', '0.5');
        },
        success: function(data) {
           $('#user-table').html(data).css('opacity', '1');
        },
        error: function() {
            alert('Something went wrong');
        }
    });
});

// Toggle status
function toggleBtn(userId) {
    $.ajax({
        url: "/admin/user-toggle-status/" + userId,
        type: "POST",
        data: {
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            alert(res.message);
        },
        error: function() {
            alert('Error updating status');
        }
    });
}
</script>
@endpush
@endsection