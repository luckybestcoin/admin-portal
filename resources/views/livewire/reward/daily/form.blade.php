<div>
    <section class="content">
        <div class="container-fluid">
                <!-- Session Idle Timeout card start -->
                <form wire:submit.prevent="submit">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form</h3>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th>No.</th>
                                    <th>Date</th>
                                    <th>Reward (%)</th>
                                </tr>
                            @for ($i = 0; $i < $diff; $i++)
                            <tr>
                                <td class="align-middle">
                                    {{ $i + 1 }}
                                </td>
                                <td>
                                    <input type="text" class="form-control" wire:model.defer="date.{{ $i }}" autocomplete="off" readonly>
                                    @error('date.'.$i)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" step="any" min="0" max="3" class="form-control" wire:model.defer="reward.{{ $i }}" autocomplete="off">
                                    @error('date.'.$i)
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </td>
                            </tr>
                            @endfor
                            </table>
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
    <!-- page body end -->=
</div>
