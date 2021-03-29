<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        &nbsp;
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Referral</th>
                                <th>Phone</th>
                                <th>Contract</th>
                                <th>App Key</th>
                                <th>Wallet Username</th>
                                <th>Address</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->member_user }}</td>
                                <td class="align-middle">{{ $row->member_email }}</td>
                                <td class="align-middle">{{ $row->parent? $row->parent->member_user: "" }}</td>
                                <td class="align-middle">{{ $row->member_phone }}</td>
                                <td class="align-middle">{{ number_format($row->contract_price, 2) }}</td>
                                <td class="align-middle">{{ $row->app_key }}</td>
                                <td class="align-middle">{{ $row->username }}</td>
                                <td class="align-middle">{{ $row->address }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group">
                                    @if ($key === $row->getKey())
                                        <a href="javascrpt:void(0)" wire:click="clear()" class="btn btn-xs btn-danger">Yes, Reset</a>
                                        <a href="javascrpt:void(0)" wire:click="cancel()" class="btn btn-xs btn-success">Cancel</a>
                                    @else
                                        <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-xs btn-danger">Reset APP Key</a>
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
