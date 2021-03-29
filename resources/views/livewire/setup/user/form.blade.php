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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" wire:model.defer="username" @if ($key)
                                            readonly
                                        @endif autocomplete="off">
                                        @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" wire:model.defer="name" autocomplete="off">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" wire:model.defer="password" autocomplete="off">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="note note-warning">
                                        <div class="note-content">
                                            <h4><b>Access</b></h4>
                                            @error('access') <span class="text-danger">{{ $message }}</span> @enderror
                                            <hr>
                                            <div class="height-400" style="display: block; position: relative; overflow: auto;">
                                                <div class="row">
                                                    @php
                                                        function sub_menu($menu, $class, $access) {
                                                            $sub_menu = "";
                                                            foreach ($menu as $i => $mn) {
                                                                $sub_menu .="<div class='hakaccess'>
                                                                    <input type='checkbox' class='".$class."' wire:model='access' onchange='hakaccess(this)' id='".$mn['id']."' value='".$mn['id']."'/>
                                                                    ".$mn['title']."
                                                                </div>";
                                                            }
                                                            return $sub_menu;
                                                        }
                                                    @endphp
                                                    @foreach ($data_menu as $i => $mn)
                                                    <div class="hakaccess col-md-6 col-lg-6 col-xl-4 pb-3">
                                                        <input type="checkbox" wire:model="access" onchange="hakaccess(this)" id="{{ $mn['id'] }}" value="{{ $mn['id'] }}" />
                                                        <label for="{{ $mn['id'] }}">{{ $mn['title'] }}
                                                        </label>
                                                        <div class="pl-3">
                                                            {!! sub_menu($mn['sub_menu'], $mn['id'], $access) !!}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <input type="submit" value="Submit" class="btn btn-success">&nbsp;
                            <a href="{{ $back }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </div>
                </form>
                <!-- Session Idle Timeout card end -->
            </div>
        </div>
    </div>
    <!-- page body end -->
    @push('scripts')
    <script>
		function hakaccess(elmt) {
            $('.' + $(elmt).val()).each(function() {
                var id = $(this).val();
                var child = $("#" + id);
                child.prop('checked', $(elmt).is(':checked'));
                if (child.is(':checked')) {
                    window.livewire.emit('set:tambahhakaccess', child.val());
                }else{
                    window.livewire.emit('set:hapushakaccess', child.val());
                }
            });
		}
        Livewire.on('reinitialize', id => {
            $('.selectpicker').selectpicker();
        });
    </script>
    @endpush
</div>

