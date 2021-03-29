<div>
    @push('css')
    <link rel="stylesheet" href="/plugins/bootstrap-select/dist/css/bootstrap-select.min.css">
    @endpush
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header form-inline">
                    <div class="form-group">
                        <input type="number" class="form-control" wire:model.lazy="skip" autocomplete="off">
                    </div>&nbsp;
                    <div class="form-group">
                        <input type="number" class="form-control" wire:model.lazy="limit" autocomplete="off">
                    </div>&nbsp;
                    <div class="form-group">
                        <select class="selectpicker form-control" data-size="10" data-live-search="true" wire:model.lazy="member" style="width: 100%;">
                            <option value="">--Choose One--</option>
                            @foreach ($data_member as $member)
                            <option value="{{ $member->username }}" class="text-dark">{{ $member->username }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table text-left p-0">
                        <tr>
                            <th>Timestamp</th>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Fee</th>
                            <th>Confs</th>
                            <th>Comments</th>
                            <th>Info</th>
                        </tr>
                        @if ($data)
                        @foreach ($data->sortByDesc('time') as $item)
                        @if ($item['category'] == 'move')
                        <tr>
                            <td>{{ date('Y-m-d h:m:s', $item['time']) }}</td>
                            <td>{{ $item['otheraccount'] }}</td>
                            <td>{{ $item['category'] }}</td>
                            <td class="text-right">{{ number_format($item['amount'], 8) }}</td>
                            <td class="text-right">-</td>
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
                            <td class="text-right">{{ $item['category'] == 'send'? number_format($item['fee'], 8): "-" }}</td>
                            <td class="text-center">{{ $item['confirmations'] > 1? 1: $item['confirmations'] }}/1</td>
                            <td>-</td>
                            <td><a href="https://explorer.luckybestcoin.com/tx/{{ $item['txid'] }}" class="text-primary" target="_blank">Info</a></td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
    <script type="text/javascript" src="/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function(){
            init();
        });

        Livewire.on('reinitialize', () => {
            init();
        });

        function init() {
            $(".selectpicker").selectpicker('refresh');
        }
    </script>
    @endpush
</div>
