
<nav class="main-header navbar navbar-expand text-sm navbar-dark navbar-lightblue">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item  d-none d-sm-inline-block">
            <a href="#" class="nav-link badge-pill badge badge-warning text-dark"><h6><strong id="lbc-balance"></strong></h6></a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="javascript:;" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="feather icon-log-out"></i><i class="fas fa-sign-out-alt mr-2"></i> {{ __('Log Out') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

@push('scripts')
<script>
    $(document).ready(function(){
        $.get("/balance", function (result){
            $("#lbc-balance").text(result);
        });
    });
</script>
@endpush
