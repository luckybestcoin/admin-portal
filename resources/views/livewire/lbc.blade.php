<div>
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
                                    <b>Username</b>&nbsp;<a class="float-right">{{ auth()->user()->username }}</a>
                                </li>
                            </ul>
                            <a href="/wallet/send" class="btn btn-primary btn-block"> Send</a>
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
                                    @foreach (collect(bitcoind()->listtransactions(auth()->user()->username, 1000)->result())->sortByDesc('time') as $item)
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
                                        <td>{{ $item['label']? $item['label']: '' }}</td>
                                        <td><a href="https://explorer.luckybestcoin.com/tx/{{ $item['txid'] }}" target="_blank">Info</a></td>
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
    </section>
</div>
