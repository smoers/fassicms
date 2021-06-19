<div class="row mb-3">
    <div class="d-flex justify-content-start">
        <div class="custom-control custom-switch">
            <input wire:model="edit" class="custom-control-input" type="checkbox" id="edit">
            <label class="custom-control-label" for="edit">{{ __('Edit') }}</label>
        </div>
        <button type="submit" class="btn btn-primary moco-btn-sm" wire:click='submit' @if(!$edit) disabled @endif  >{{__('Save')}}</button>
    </div>
</div>
