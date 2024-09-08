@foreach ($data as $item => $value)
    <div class="row bg-biru align-items-center my-3 py-3">
        <div class="col-1 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-circle">
                <circle cx="12" cy="12" r="10"></circle>
            </svg>
        </div>
        <div class="col-11 text-white">
            <!-- <h4>{{ $value->headline }}</h4> -->
            @if(App::getLocale() == 'id' )
                <h4>{{ $value->headline }}</h4>
            @elseif(App::getLocale() != 'id' )
                <h4>{{ $value->headline_en }}</h4>
            @endif
            <p class="m-0">{{ $value->start_date }} - {{ $value->end_date }}</p>
            <!-- <p class="m-0">{{ $value->deskripsi }}</p> -->
            @if(App::getLocale() == 'id' )
                <p class="m-0">{{ $value->deskripsi }}</p>
            @elseif(App::getLocale() != 'id' )
                <p class="m-0">{{ $value->deskripsi_en }}</p>
            @endif
        </div>
    </div>
@endforeach
