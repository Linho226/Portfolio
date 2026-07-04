@if(session('success'))
<div class="alert alert-success border-0 rounded-3 mb-4" style="background:rgba(16,185,129,.1);color:#6ee7b7;border:1px solid rgba(16,185,129,.3)!important;">
    <strong>✓</strong> {{ session('success') }}
</div>
@endif
@if(session('error'))
<div class="alert alert-danger border-0 rounded-3 mb-4">{{ session('error') }}</div>
@endif
