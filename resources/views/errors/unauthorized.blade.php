@extends('layouts.admin')

@section('title', 'Unauthorized')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 403 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Unauthorized Access</p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="{{ route('dashboard') }}">&larr; Back to Dashboard</a>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('scripts')
<script>
    // Disable sidebar toggling and scrolling for this page
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('sidebar-toggled');
        document.querySelector('.sidebar').classList.add('toggled');
    });
</script>
@endsection

@section('styles')
<style>
    .error {
        color: #5a5c69;
        font-size: 7rem;
        position: relative;
        line-height: 1;
        width: 12.5rem;
    }
</style>
@endsection
