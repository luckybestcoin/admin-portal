<div>
    <section class="content">
        <div class="container-fluid">
            @include('includes.notification')
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-tools form-inline mt-1">
                        <div class="input-group input-group-sm">
                            <select class="form-control" data-style="btn-primary" wire:model="deleted" data-live-search="true">
                                <option value="0">Unprocessed</option>
                                <option value="1">Processed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-1">
                    <table class="table table-hovered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Rating</th>
                                <th>Reward</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->member->member_user }}</td>
                                <td class="align-middle">{{ $row->member->member_name }}</td>
                                <td class="align-middle">{{ $row->member->member_email }}</td>
                                <td class="align-middle">{{ $row->rating->rating_name.", ".number_format($row->rating->rating_min_turnover, 2) }}</td>
                                <td class="align-middle">{{ $row->rating->rating_reward }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group">
                                    @if (!$row->process)
                                        @if ($key === $row->getKey())
                                            <a href="javascrpt:void(0)" wire:click="process()" class="btn btn-success">Yes, Process</a>
                                            <a href="javascrpt:void(0)" wire:click="batal()" class="btn btn-danger">Cancel</a>
                                        @else
                                            <a href="javascrpt:void(0)" wire:click="setKey({{ $row->getKey() }})" class="btn btn-success">Process</a>
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