<div>
    <!-- page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Session Idle Timeout card start -->
                <form wire:submit.prevent="submit">
                    <div class="card">
                        <div class="card-block">
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
                            <input type="submit" value="Simpan" class="btn btn-success">
                            &nbsp;
                            <a href="{{ $back }}" class="btn btn-danger">Batal</a>
                        </div>
                    </div>
                </form>
                <!-- Session Idle Timeout card end -->
            </div>
        </div>
    </div>
    <!-- page body end -->
    @include('includes.error')
    @push('scripts')
    <!-- Masking js -->
    <script src="/assets/pages/form-masking/inputmask.js"></script>
    <script src="/assets/pages/form-masking/jquery.inputmask.js"></script>
    <script src="/assets/pages/form-masking/autoNumeric.js"></script>
    <script src="/assets/pages/form-masking/form-mask.js"></script>
    @endpush
</div>
