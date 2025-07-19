    @if (session('success') || $errors->any())
            <div class="position-fixed top-0 start-50 translate-middle-x p-5" style="z-index: 9999">
                <div class="toast align-items-center text-white {{ session('success') ? 'bg-primary' : 'bg-danger' }} border-0 show"
                    role="alert" aria-live="assertive" aria-atomic="true" id="feedbackToast">
                    <div class="d-flex">
                        <div class="toast-body">
                            @if (session('success'))
                                {{ session('success') }}
                            @elseif ($errors->any())
                                {{ $errors->first() }}
                            @endif
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            </div>
        @endif
