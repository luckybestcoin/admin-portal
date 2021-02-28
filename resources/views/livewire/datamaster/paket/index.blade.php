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
                        <a href="{{ route('datamaster.paket.tambah') }}" class="btn btn-primary">Tambah Data</a>
                    @endrole
                        <div class="float-right form-inline">
                            <select class="form-control selectpicker" data-style="btn-primary" wire:model="deleted" data-live-search="true">
                                <option value="0">Exist</option>
                                <option value="1">Deleted</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Pencarian" wire:model="cari">
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-framed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Paket</th>
                                        <th>Harga Paket</th>
                                        <th>Pin</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $i => $row)
                                    <tr>
                                        <td class="align-middle">{{ ++$no }}</td>
                                        <td class="align-middle">{{ $row->paket_nama }}</td>
                                        <td class="align-middle">{{ number_format($row->paket_harga, 2) }}</td>
                                        <td class="align-middle">{{ number_format($row->paket_pin) }}</td>
                                        <td class="with-btn-group align-middle text-right text-nowrap">
                                        @role('super-admin|user')
                                            <div class="btn-group btn-group-sm dropdown-split-primary">
                                            @if ($row->trashed())
                                                @if ($key === $row->getKey())
                                                    <a href="javascrpt:void(0)" wire:click="restore()" class="btn btn-success">Ya, Restore</a>
                                                    <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-danger">Batal</a>
                                                @else
                                                    <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-success">Restore</a>
                                                @endif
                                            @else
                                                @if ($key === $row->getKey())
                                                    <a href="javascrpt:void(0)" wire:click="hapus()" class="btn btn-danger">Ya, Hapus</a>
                                                    <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-success">Batal</a>
                                                @else
                                                    <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-danger">Hapus</a>
                                                    <button type="button"
                                                            class="btn btn-inverse dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <span class="sr-only">Toggle primary</span>
                                                    </button>
                                                    <div class="dropdown-menu" >
                                                        <a class="dropdown-item waves-effect waves-light" href="{{ route('datamaster.paket.edit', [ 'key' => $row->getKey() ]) }}">Edit</a>
                                                    </div>
                                                @endif
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
