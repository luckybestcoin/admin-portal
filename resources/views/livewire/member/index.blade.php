<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        @role('super-admin|user')
                            <a href="{{ route('member.registration') }}" class="btn btn-sm btn-primary">New</a>
                        @endrole
                    </div>
                    <div class="card-tools form-inline mt-1">
                        <div class="input-group input-group-sm">
                            <select class="form-control" data-style="btn-primary" wire:model="deleted" data-live-search="true">
                                <option value="0">Activated</option>
                                <option value="1">Not Activated</option>
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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Wallet Username</th>
                                <th>Referral</th>
                                <th>Phone</th>
                                <th>Contract</th>
                                <th>Referral Code</th>
                                <th>Status</th>
                                <th>Registration Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->member_user }}</td>
                                <td class="align-middle">{{ $row->member_email }}</td>
                                <td class="align-middle">{{ $row->username }}</td>
                                <td class="align-middle">{{ $row->parent? $row->parent->member_user: "" }}</td>
                                <td class="align-middle">{{ $row->member_phone }}</td>
                                <td class="align-middle">{{ number_format($row->contract_price, 2) }}</td>
                                <td class="align-middle">{{ $row->referral->referral_token }}</td>
                                <td class="align-middle">{{ $row->member_user? "activated": "not activated" }}</td>
                                <td class="align-middle">{{ $row->created_at }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group">
                                        @if ($deleted == 1)
                                        <a href="javascript:;" wire:click="referral({{ $row->getKey() }})" class="btn btn-xs btn-success">Send Referral</a>
                                        @endif
                                        <a href="/member/edit/{{ $row->getKey() }}" class="btn btn-xs btn-primary">Edit</a>
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
            @include('includes.notification')
        </div>
    </section>
</div>
