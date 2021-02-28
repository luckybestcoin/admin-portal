<div>
@section('title', ' | Registrasi Member')

@section('subcontent')
    <!-- page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Session Idle Timeout card start -->
                <form wire:submit.prevent="submit">
                    <div class="card">
                        <div class="card-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>UID</label>
                                        <input type="text" class="form-control" wire:model.defer="uid" autocomplete="off">
                                        @error('uid')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Session Idle Timeout card end -->
            </div>
        </div>
    </div>
    <!-- page body end -->
@endsection
</div>
