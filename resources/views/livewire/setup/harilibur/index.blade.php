<div>
    <!-- page body start -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Session Idle Timeout card start -->
                <div class="card">
                    <div class="card-header">
                    @role('super-admin|user')
                        <a href="{{ route('setup.harilibur.tambah') }}" class="btn btn-primary">Tambah Data</a>
                    @endrole
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table table-framed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal <small class="text-warning">(yyyy-mm-dd)</small></th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $i => $row)
                                    <tr>
                                        <td class="align-middle">{{ ++$no }}</td>
                                        <td class="align-middle">{{ $row->hari_libur_tanggal }}</td>
                                        <td class="align-middle">{{ $row->hari_libur_keterangan }}</td>
                                        <td class="with-btn-group align-middle text-right text-nowrap">
                                        @role('super-admin|user')
                                            <div class="btn-group btn-group-sm dropdown-split-primary">
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
                                                    <a class="dropdown-item waves-effect waves-light" href="{{ route('setup.harilibur.edit', [ 'key' => $row->getKey() ]) }}">Edit</a>
                                                </div>
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
</div>
