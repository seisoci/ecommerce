@props(['imgChange','imageDate','imgName','imgLink'])
<div class="card iq-file-manager">
    <div class="card-body">
        <div class="position-relative iq-video-hover">
            <a data-fslightbox="html5-video" href="{{asset('images/pro/plugins/video-2.mp4')}}">
                <img src="{{asset('modules/file-manager/images')}}/{{$imgChange}}" class="img-fluid" alt="">
                <div class="iq-btn-video btn btn-white text-primary rounded-pill btn-icon position-absolute">
                    <span class="text-white">
                        <svg viewBox="0 0 44 44" fill="none" width="24" height="35" xmlns="http://www.w3.org/2000/svg">
                            <path
                            d="M15.8817 9.20912C14.5492 8.3891 12.8335 9.3478 12.8335 10.9124V33.0875C12.8335 34.6522 14.5492 35.6109 15.8817 34.7908L33.8989 23.7033C35.168 22.9223 35.168 21.0776 33.8989 20.2967L15.8817 9.20912Z"
                            fill="currentColor"></path>
                        </svg>
                    </span>
                </div>
            </a>
        </div>
        <div class="mt-3">
            <p class="small mb-2 text-muted">Created on {{$imageDate}}</p>
            <div class="d-flex align-items-center mb-2 text-primary">
                <svg class="icon-24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.4" d="M21.3309 7.44251C20.9119 7.17855 20.3969 7.1552 19.9579 7.37855L18.4759 8.12677C17.9279 8.40291 17.5879 8.96129 17.5879 9.58261V15.4161C17.5879 16.0374 17.9279 16.5948 18.4759 16.873L19.9569 17.6202C20.1579 17.7237 20.3729 17.7735 20.5879 17.7735C20.8459 17.7735 21.1019 17.7004 21.3309 17.5572C21.7499 17.2943 21.9999 16.8384 21.9999 16.339V8.66179C21.9999 8.1623 21.7499 7.70646 21.3309 7.44251Z" fill="currentColor"></path>
                    <path d="M11.9051 20H6.11304C3.69102 20 2 18.3299 2 15.9391V9.06091C2 6.66904 3.69102 5 6.11304 5H11.9051C14.3271 5 16.0181 6.66904 16.0181 9.06091V15.9391C16.0181 18.3299 14.3271 20 11.9051 20Z" fill="currentColor"></path>
                </svg>
                <p class="ms-2 mb-0 text-dark">Video-{{$imgName}}</p>
            </div>
            <small class="text-muted">You opened <a href="javascript:void(0)">{{$imgLink}}</a></small>
        </div>
    </div>
</div>
