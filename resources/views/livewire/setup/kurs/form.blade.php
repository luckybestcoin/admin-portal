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
                                <label>Kurs Jual</label>
                                <input type="text" class="form-control autonumber text-right" onchange="@this.set('kurs_jual', this.value)" value="{{ $kurs_jual }}" autocomplete="off">
                                @error('kurs_jual')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Kurs Beli</label>
                                <input type="text" class="form-control autonumber text-right" onchange="@this.set('kurs_beli', this.value)" value="{{ $kurs_beli }}" autocomplete="off">
                                @error('kurs_jual')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="submit" value="Simpan" class="btn btn-success">
                            &nbsp;
                            <a href="{{ route('setup.kurs') }}" class="btn btn-danger">Data Kurs</a>
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
