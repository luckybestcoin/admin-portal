<div>
    @push('css')
        <link rel="stylesheet" type="text/css" href="/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css">
    @endpush
<!-- page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Session Idle Timeout card start -->
                <div class="card">
                    <div class="card-header">
                        @role('super-admin|user')
                        <a href="{{ route('setup.kurs.tambah') }}" class="btn btn-primary">Input Data</a>
                        @endrole
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-framed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tangagl</th>
                                    <th>Kurs Jual</th>
                                    <th>Kurs Beli</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $i => $row)
                                    <tr>
                                        <td class="align-middle">{{ ++$no }}</td>
                                        <td class="align-middle">{{ $row->created_at }}</td>
                                        <td class="align-middle">{{ number_format($row->kurs_jual, 2) }}</td>
                                        <td class="align-middle">{{ number_format($row->kurs_beli, 2) }}</td>
                                        <td class="with-btn-group align-middle text-right text-nowrap">
                                            @role('super-admin')
                                            <div class="btn-group btn-group-sm dropdown-split-primary">
                                                @if ($key === $row->getKey())
                                                    <a href="javascrpt:void(0)" wire:click="hapus()" class="btn btn-danger">Ya, Hapus</a>
                                                    <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-success">Batal</a>
                                                @else
                                                    <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-danger">Hapus</a>
                                                @endif
                                            </div>
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Session Idle Timeout card end -->
            </div>
        </div>
    </div>
    <!-- page body end -->
    @include('includes.error')
    @push('scripts')
        <script src="/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
        <script>
            Livewire.on('reinitialize', id => {
                $('.selectpicker').selectpicker();
            });
        </script>
    @endpush
</div>
