<!-- Jumlah Murid -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        Pending</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pending_count }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-spinner fa-2x text-gray-300"></i>
                    {{-- <i class="fas fa-calendar fa-2x text-gray-300"></i> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumlah Murid Laki-Laki -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Confirmed
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $confirmed_count }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-pen fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jumlah Murid Perempuan -->
<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Active</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_count }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Ajuan Cancelled</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ajuanCancelled_count }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-eraser fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-3 col-md-4 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        Cancelled</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $cancelled_count }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
