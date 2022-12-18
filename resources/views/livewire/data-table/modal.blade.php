<!-- Message avant la sauvegarde -->
<div class="modal" id="modal_message" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-sm-center align-items-center">
                        <p class="moco-color-error h4"><i class="fas fa-exclamation-triangle fa-2x mr-2"></i> {{__('Attention')}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="moco-color-error moco" id="message"></div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="d-flex justify-content-md-between">
                        <button type="button" id="continueModal" class="btn btn-danger" data-dismiss="modal">{{__('Continue')}}</button>
                        <button type="button" id="saveModal" class="btn btn-success" data-dismiss="modal">{{__('Save')}}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function (){
        $('#saveModal').on('click',function (){
            window.livewire.emit('save');
        })
        $('#continueModal').on('click',function (){
            window.livewire.emit('seteditmode');

        })
        window.addEventListener('openMessageModal', event => {
            $('#message').html(event.detail.message);
            $("#modal_message").modal('show');
        })
        window.addEventListener('closeMessageModal', event => {
            $("#modal_message").modal('hide');
        })
    })
</script>

