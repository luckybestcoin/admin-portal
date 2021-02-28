<div>
    <section class="content">
        <div class="container-fluid">
                <!-- Session Idle Timeout card start -->
                <form wire:submit.prevent="submit">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Paket</label>
                                <input type="text" class="form-control" wire:model.defer="nama_paket" autocomplete="off">
                                @error('nama_paket')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" class="form-control autonumber text-right" onchange="@this.set('harga', this.value)" value="{{ $harga }}" autocomplete="off">
                                @error('harga')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>PIN</label>
                                <input type="number" class="form-control" wire:model.defer="pin" autocomplete="off">
                                @error('pin')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <input type="submit" value="Submit" class="btn btn-success">&nbsp;
                            <a href="{{ $back }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
                <!-- Session Idle Timeout card end -->
            </div>
        </div>
    </div>
    <!-- page body end -->=
</div>
