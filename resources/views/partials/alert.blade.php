@if (session('success'))
    <div id="floating-alert" class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
        <div class="d-flex align-items-center">
            <ion-icon name="checkmark-circle" class="me-2"></ion-icon>
            <div>
                {{ session('success') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if (session('error'))
    <div id="floating-alert" class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
        <div class="d-flex align-items-center">
            <ion-icon name="alert-circle" class="me-2"></ion-icon>
            <div>
                {{ session('error') }}
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($errors->any())
    <div id="floating-alert" class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
        <div class="d-flex align-items-center">
            <ion-icon name="alert-circle" class="me-2"></ion-icon>
            <div>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
