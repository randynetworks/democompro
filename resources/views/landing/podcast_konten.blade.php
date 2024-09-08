@foreach ($data as $srt)
    @if(isset($srt->video_link_embed))
        <p style="color: red;">{{$srt->video_link_embed}}</p>
    @endif
    <div class="col-lg-4 col-md-6 mb-4 pb-2">
        <div class="tiny-slide tns-item tns-slide-active" id="tns1-item2">
            <div class="card border-0 work-container work-primary work-grid position-relative d-block overflow-hidden my-2 mx-1">
                <div class="card-body p-0"  style="height: 200px;">
                    <div class="embed-responsive embed-responsive-16by9"
                        style="height: 0; overflow: hidden; position: relative; padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden;">
                        @if(isset($srt->youtube_link_embed) && !empty($srt->youtube_link_embed))
                            <iframe class="embed-responsive-item" src="{{ $srt->youtube_link_embed }}" allowfullscreen
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
                        @elseif(isset($srt->video_file) && !empty($srt->video_file))
                        <video controls style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;" >
                            <source src="{{ asset('/images/podcast/' . $srt->video_file) }}" type="video/mp4">
                        </video>
                        @endif
                    </div>
                    
                </div>
            </div>
            
            <h5><a href="javascript:void(0)" class="card-title title text-dark">{{ $srt->judul }}</a></h5>
        </div>
    </div>
@endforeach
