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
                                <label>Tanggal <small class="text-warning">(yyyy-mm-dd)</small></label>
                                <input type="text" class="form-control date" onkeyup="@this.set('tanggal', this.value)" value="{{ $tanggal }}" autocomplete="off">
                                @error('tanggal')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" wire:model.defer="keterangan" autocomplete="off">
                                @error('keterangan')
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
    <script src="/assets/pages/form-masking/form-mask.js"></script>
    @endpush
</div>
