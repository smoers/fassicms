<div class="d-flex flex-row justify-content-start">
    <div class="mr-3">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{__('Worksheets for')}}</div>
            </div>
            <input wire:model='year' type="text" class="form-control" id="_year" placeholder="{{__('Year')}}" value="{{ $year }}" @if($template) readonly @endif>
        </div>
    </div>
    <div class="mr-3">
        <div class="custom-control custom-switch">
            <input wire:model="template" class="custom-control-input" type="checkbox" id="_template">
            <label class="custom-control-label" for="_template">{{ __('Worksheets template') }}</label>
        </div>
    </div>
    <div class="mr-3">
        <div class="custom-control custom-switch">
            <input wire:model="validate" class="custom-control-input" type="checkbox" id="_validate">
            <label class="custom-control-label" for="_validate">{{ __('Worksheets validated') }}</label>
        </div>
    </div>
</div>
