<div>
    <section class="content">
        <div class="container-fluid">
            @foreach ($notification as $item)
            <div class="alert alert-warning">
                {!! $item !!}
            </div>
            @endforeach
        </div>
    </section>
</div>
