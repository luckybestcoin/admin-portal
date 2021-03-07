<div>
    @push('css')
    <link rel="stylesheet" href="/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    @endpush
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="/images/user.png"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ auth()->user()->user_name }}</h3>

                            <p class="text-muted text-center">{{ auth()->user()->user_email }}</p>

                            <ul class="list-group list-group-unbordered mb-3 table-responsive">
                                <li class="list-group-item">
                                    <b>Username</b>&nbsp;<a class="float-right">administrator</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b>&nbsp;<a class="float-right">{{ bitcoind()->getaccountaddress('administrator') }}</a>
                                </li>
                            </ul>
                            <button wire:click="show" class="btn btn-primary btn-block"> Send</button>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-body">
                            <h4>Recent Transaction</h4>
                            <div class="table-responsiv overflow-auto" style="height: 500px">
                                <table class="table">
                                    <tr>
                                        <th>Timestamp</th>
                                        <th>Address</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Confs</th>
                                        <th>Comments</th>
                                        <th>Info</th>
                                    </tr>
                                    @foreach (collect(bitcoind()->listtransactions("administrator", 30)->result())->sortByDesc('time') as $item)
                                    @if ($item['category'] == 'move')
                                    <tr>
                                        <td>{{ date('Y-m-d h:m:s', $item['time']) }}</td>
                                        <td>{{ $item['otheraccount'] }}</td>
                                        <td>{{ $item['category'] }}</td>
                                        <td class="text-right">{{ number_format($item['amount'], 8) }}</td>
                                        <td>-</td>
                                        <td>{{ $item['comment'] }}</td>
                                        <td>-</td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td>{{ date('Y-m-d h:m:s', $item['time']) }}</td>
                                        <td>{{ $item['address'] }}</td>
                                        <td>{{ $item['category'] }}</td>
                                        <td class="text-right">{{ number_format($item['amount'], 8) }}</td>
                                        <td>{{ $item['confirmations'] }}</td>
                                        <td>{{ $item['label'] }}</td>
                                        <td><a href="http://explore.luckybestcoin.com:3001/tx/{{ $item['txid'] }}" target="_blank">Info</a></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div wire:ignore.self class="modal fade" id="default-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form wire:submit.prevent="submit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Send</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Destination</label>
                                <select class="select2 destination" wire:model="destination" style="width: 100%;">
                                    <option value=""></option>
                                    @foreach ($member_data as $member)
                                    <option value="{{ $member->username }}">{{ $member->member_user." (".$member->member_name.")" }}</option>
                                    @endforeach
                                </select>
                                @error('destination')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>LBC Amount</label>
                                <input type="number" class="form-control" step="any" wire:model.defer="amount" autocomplete="off">
                                @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" wire:model.defer="password" autocomplete="off">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="alert alert-warning">When you click <strong>Accept & Go</strong>, the process cannot be undone!!!</div>
                            @include('includes.error-validation')
                            @include('includes.notification')
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Accept & Go</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @push('scripts')
    <!-- Masking js -->
        <script type="text/javascript" src="/plugins/select2/js/select2.full.min.js"></script>
        <script>
            $(document).ready(function(){
                init();
            });

            Livewire.on('reinitialize', () => {
                init();
            });

            function init() {
                $(".destination").select2();

                $(".destination").on("change", function(e) {
                    window.livewire.emit('set:setdestination', $(this).select2('data')[0]['id']);
                });
            }

            Livewire.on('show', id => {
                $('#default-modal').modal('toggle');
                init();
            });

            Livewire.on('done', id => {
                $('#default-modal').modal('toggle');
            });
        </script>
    @endpush
</div>
