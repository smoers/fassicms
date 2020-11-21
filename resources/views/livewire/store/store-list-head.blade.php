<div class="row">
    <div class="col-2">
        <label class="sr-only" for="inlineFormInputGroup">Username</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{__('Price catalogue')}}</div>
            </div>
             <input wire:model='year' type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{__('Year')}}" value="{{ $year }}">
        </div>
    </div>
    <div class="col-2">
        <div class="custom-control custom-switch">
            <input wire:model="enabled" class="custom-control-input" type="checkbox" id="autoSizingCheck">
            <label class="custom-control-label" for="autoSizingCheck">{{ __('Active parts') }}</label>
        </div>
    </div>
</div>
