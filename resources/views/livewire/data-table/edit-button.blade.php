<div class="d-flex flex-row">
    @if($this->edit)
        <a href="#" class="btn btn-danger moco-btn-sm mr-2" wire:click="editMode" id="editmode"><i class="fas fa-edit"></i> {{__('Out Edit Mode')}}</a>
        <a href="#" class="btn btn-success moco-btn-sm mr-2" wire:click="save" id="save"><i class="fas fa-save"></i> {{__('Save')}}</a>
    @endif
    @if ($errors->any())
        @foreach($errors->all() as $error)
            <script type="text/javascript">
                iziToast.error({
                    title: '{{__('Error')}}',
                    message: '{{__($error)}}',
                    timeout: 10000,
                });
            </script>
        @endforeach
    @endif
</div>
