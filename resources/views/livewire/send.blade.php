<div>
    @push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    @endpush
    <section class="content">
        <div class="container-fluid">
            <form wire:submit.prevent="submit">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Destination</label>
                            <select class="form-control selectpicker" title="Nothing Selected" data-live-search="true" wire:model.defer="destination" data-style="btn-primary">
                                @foreach ($member_data as $member)
                                <option value="{{ $member->username }}">{{ $member->member_user." (".$member->member_name.", wallet : ".$member->username.")" }}</option>
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
                        <div class="form-group">
                            <label>Note</label>
                            <input type="text" class="form-control" wire:model.defer="note" autocomplete="off">
                            @error('note')
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
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-primary">Accept & Go</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    @push('scripts')
    <!-- Masking js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
        <script>
            $(document).ready(function(){
                init();
            });

            Livewire.on('reinitialize', () => {
                init();
            });

            function init() {
                $('.selectpicker').selectpicker('refresh');
            }
        </script>
    @endpush
</div>
