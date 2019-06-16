<div id="message">
@if (session('success'))
    <div style="padding: 5px;">
        <div id="inner-message" class="alert alert-success">
            <i class="fa fa-check fa-2x"></i> {{ session('success') }}
        </div>
    </div>
@endif
@if (session('error'))
    <div style="padding: 5px;">
        <div id="inner-message" class="alert alert-danger">
            <i class="fa fa-exclamation-triangle fa-2x"></i> {{ session('error') }}
        </div>
    </div>
@endif
</div>
