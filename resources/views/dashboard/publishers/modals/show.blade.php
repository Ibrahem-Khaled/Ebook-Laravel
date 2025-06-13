<div class="modal fade" id="showPublisherModal{{ $publisher->id }}" tabindex="-1" role="dialog" aria-labelledby="showPublisherModalLabel{{ $publisher->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showPublisherModalLabel{{ $publisher->id }}">تفاصيل الناشر: {{ $publisher->publisher_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($publisher->image)
                            <img src="{{ asset('storage/' . $publisher->image) }}" alt="{{ $publisher->publisher_name }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @else
                            <img src="{{ asset('img/default-publisher.png') }}" alt="صورة افتراضية" class="img-fluid rounded mb-3" style="max-height: 300px;">
                        @endif
                        
                        <div class="social-icons text-center mb-3">
                            @if($publisher->fb)
                                <a href="{{ $publisher->fb }}" target="_blank" class="text-primary mx-2" title="فيسبوك">
                                    <i class="fab fa-facebook-f fa-2x"></i>
                                </a>
                            @endif
                            @if($publisher->yt)
                                <a href="{{ $publisher->yt }}" target="_blank" class="text-danger mx-2" title="يوتيوب">
                                    <i class="fab fa-youtube fa-2x"></i>
                                </a>
                            @endif
                            @if($publisher->telegram)
                                <a href="{{ $publisher->telegram }}" target="_blank" class="text-info mx-2" title="تلجرام">
                                    <i class="fab fa-telegram fa-2x"></i>
                                </a>
                            @endif
                            @if($publisher->whatsapp)
                                <a href="https://wa.me/{{ $publisher->whatsapp }}" target="_blank" class="text-success mx-2" title="واتساب">
                                    <i class="fab fa-whatsapp fa-2x"></i>
                                </a>
                            @endif
                            @if($publisher->instagram)
                                <a href="{{ $publisher->instagram }}" target="_blank" class="text-warning mx-2" title="إنستجرام">
                                    <i class="fab fa-instagram fa-2x"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <h4>{{ $publisher->publisher_name }}</h4>
                        <hr>
                        
                        <div class="mb-3">
                            <h5>وصف الناشر:</h5>
                            <p>{{ $publisher->desc ?? 'لا يوجد وصف' }}</p>
                        </div>
                        
                        <div class="card">
                            <div class="card-header bg-light">
                                <strong>معلومات التواصل</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if($publisher->fb)
                                        <div class="col-md-6 mb-2">
                                            <i class="fab fa-facebook-f text-primary"></i>
                                            <a href="{{ $publisher->fb }}" target="_blank">{{ $publisher->fb }}</a>
                                        </div>
                                    @endif
                                    @if($publisher->yt)
                                        <div class="col-md-6 mb-2">
                                            <i class="fab fa-youtube text-danger"></i>
                                            <a href="{{ $publisher->yt }}" target="_blank">{{ $publisher->yt }}</a>
                                        </div>
                                    @endif
                                    @if($publisher->telegram)
                                        <div class="col-md-6 mb-2">
                                            <i class="fab fa-telegram text-info"></i>
                                            <a href="{{ $publisher->telegram }}" target="_blank">{{ $publisher->telegram }}</a>
                                        </div>
                                    @endif
                                    @if($publisher->whatsapp)
                                        <div class="col-md-6 mb-2">
                                            <i class="fab fa-whatsapp text-success"></i>
                                            <a href="https://wa.me/{{ $publisher->whatsapp }}" target="_blank">{{ $publisher->whatsapp }}</a>
                                        </div>
                                    @endif
                                    @if($publisher->instagram)
                                        <div class="col-md-6 mb-2">
                                            <i class="fab fa-instagram text-warning"></i>
                                            <a href="{{ $publisher->instagram }}" target="_blank">{{ $publisher->instagram }}</a>
                                        </div>
                                    @endif
                                    @if(!$publisher->fb && !$publisher->yt && !$publisher->telegram && !$publisher->whatsapp && !$publisher->instagram)
                                        <div class="col-12">
                                            <p class="text-muted">لا يوجد معلومات تواصل</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>