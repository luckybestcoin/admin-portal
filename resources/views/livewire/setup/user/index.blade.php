<div>
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        @role('super-admin|user')
                            <a href="{{ route('setup.user.add') }}" class="btn btn-sm btn-primary">New</a>
                        @endrole
                    </div>
                    <div class="card-tools form-inline mt-1">
                        <select class="form-control" data-style="btn-primary" wire:model="deleted" data-live-search="true">
                            <option value="0">Exist</option>
                            <option value="1">Deleted</option>
                        </select>
                        <div class="input-group">
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
                                <th>Name</th>
                                <th>Level</th>
                                <th>Access</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $i => $row)
                            <tr>
                                <td class="align-middle">{{ ++$no }}</td>
                                <td class="align-middle">{{ $row->user_nick }}</td>
                                <td class="align-middle">{{ $row->user_nick }}</td>
                                <td>{{ ucFirst($row->getRoleNames()->count() > 0? $row->getRoleNames()->first(): null) }}</td>
                                <td class="align-middle">{{ $row->getAllPermissions()->pluck('name') }}</td>
                                <td class="with-btn-group align-middle text-right text-nowrap">
                                @role('super-admin|user')
                                    <div class="btn-group" role="group">
                                        @if ($row->trashed())
                                            @if($key==$row->getKey())
                                                <a href="javascript:;" wire:click="restore()" class="btn btn-success">Yes, Restore</a>
                                                <a href="javascript:;" wire:click="batal()" class="btn btn-danger">Cancel</a>
                                            @else
                                                <a href="javascript:;" wire:click="key('{{ $row->getKey() }}')" class="btn btn-grey">Restore</a>
                                            @endif
                                        @else
                                            @if($key==$row->getKey())
                                                <a href="javascript:;" wire:click="delete()" class="btn btn-danger">Yes, Delete</a>
                                                <a href="javascript:;" wire:click="batal()" class="btn btn-success">Cancel</a>
                                            @else
                                                <a href="javascript:;" wire:click="key('{{ $row->getKey() }}')" class="btn btn-danger">Delete</a>
                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  </button>
                                                <div class="dropdown-menu">
                                                    <a href="/setup/user/edit/{{ $row->getKey() }}" class="dropdown-item"> Edit</a>
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
