@if (!isset($can) || Gate::check($can))
    <div class="modal fade" id="{!! $id !!}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog {!! !empty($centered)?'modal-dialog-centered':null !!} {!! $dialog_class??null !!}" role="document">
            <div class="modal-content position-relative">
                @if(!empty($form))
                    <form action="{{ $form['action']??url()->current() }}" {!! isset($form['id'])?"id=".$form['id']."":null !!} method="{{ $form['method']??'post' }}" @if(!empty($form['multipart']))enctype="multipart/form-data"@endif>
                        @endif
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $title }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">{!! $slot !!}</div>
                        <div class="modal-footer">
                            <button type="button" class="btn {{ $cancelBtnClass??'btn-secondary' }}" data-dismiss="modal">{{ $closeBtn??'Close' }}</button>
                            @empty($hide_save_btn)
                                <button type="{!! (!empty($form) && empty($form['no-submit']))?'submit':'button' !!}" class="btn {{ $saveBtnClass??'btn-success' }}">{{ $saveBtn??'Save' }}</button>
                            @endempty
                        </div>
                        @if(!empty($form))
                    </form>
                @endif
                @if (!empty($loader))
                    <div class="loader modal-loader"></div>
                @endif
            </div>
        </div>
    </div>
@endif
