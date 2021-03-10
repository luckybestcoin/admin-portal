<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        @role('super-admin|user')
                            <a href="{{ route('master.contract.add') }}" class="btn btn-primary">New</a>
                        @endrole
                    </div>
                    <div class="card-tools form-inline">
                        <div class="input-group input-group-sm">
                            <select class="form-control" data-style="btn-primary" wire:model="deleted" data-live-search="true">
                                <option value="0">Exist</option>
                                <option value="1">Deleted</option>
                            </select>
                            <input type="text" class="form-control" placeholder="Search" wire:model="cari">
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-1">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Contract</th>
                                <th>Price</th>
                                <th>Pin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->contract_name }}</td>
                                <td class="align-middle">{{ number_format($row->contract_price, 2) }}</td>
                                <td class="align-middle">{{ number_format($row->contract_pin) }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group">
                                    @if ($row->trashed())
                                        @if ($key === $row->getKey())
                                            <a href="javascrpt:void(0)" wire:click="restore()" class="btn btn-success">Yes, Restore</a>
                                            <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-danger">Cancel</a>
                                        @else
                                            <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-success">Restore</a>
                                        @endif
                                    @else
                                        @if ($key === $row->getKey())
                                            <a href="javascrpt:void(0)" wire:click="hapus()" class="btn btn-danger">Ya, Delete</a>
                                            <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-success">Cancel</a>
                                        @else
                                            <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-danger">Delete</a>
                                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="{{ route('master.contract.edit', [ 'key' => $row->getKey() ]) }}">Edit</a>
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
