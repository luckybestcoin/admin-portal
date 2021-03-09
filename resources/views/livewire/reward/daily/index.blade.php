<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        @role('super-admin|user')
                            <a href="{{ route('reward.daily.add') }}" class="btn btn-sm btn-primary">New</a>
                        @endrole
                    </div>
                    <div class="card-tools form-inline mt-1">
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" placeholder="Search" wire:model="cari">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-1">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Reward</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->daily_date }}</td>
                                <td class="align-middle">{{ number_format($row->daily_reward, 2) }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group">
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
                <div class="card-footer clearfix text-center">
                    <label class="float-left">Total Data : {{ $data->total() }}</label>
                    <div class="float-right pagination-sm">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
