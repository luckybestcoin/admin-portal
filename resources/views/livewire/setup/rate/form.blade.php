<div>
    @push('style')
    <link rel="stylesheet" href="/plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.js" crossorigin="anonymous" />
    @endpush
    <section class="content">
        <div class="container-fluid">
                <!-- Session Idle Timeout card start -->
                <form wire:submit.prevent="submit">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Price (USD)</label>
                                <input type="number" step="any" class="form-control" wire:model.defer="price" autocomplete="off">
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Date Time</label>
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" onchange="datetime()" id="datetimepicker" value="{{ $datetime }}" class="bg-white form-control datetimepicker-input" id="datetimeinput" data-target="#datetimepicker" readonly="readonly"/>
                                    <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                @error('datetime')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <input type="submit" value="Submit" class="btn btn-success">&nbsp;
                            <a href="{{ $back }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
                <!-- Session Idle Timeout card end -->
                <div class="col-md-12">
                    @include('includes.error-validation')
                    @include('includes.notification')
                </div>
            </div>
        </div>
    </div>
    <!-- page body end -->
    @push('scripts')
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>
        $('#datetimepicker').datetimepicker({
            Default: false,
            format: 'YYYY-MM-DD hh:mm:ss',
            sideBySide: true,
            });

        function datetime() {
            window.livewire.emit('set:setdatetime', $("#datetimepicker").val());
        }
    </script>
    @endpush
</div>
