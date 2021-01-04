<div class="row">
    <div class="col-2">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text">{{__('Worksheets for ')}}</div>
            </div>
            <input wire:model='year' type="text" class="form-control" id="_year" placeholder="{{__('Year')}}" value="{{ $year }}" @if($template) readonly @endif>
        </div>
    </div>
    <div class="col-2">
        <div class="custom-control custom-switch">
            <input wire:model="template" class="custom-control-input" type="checkbox" id="_template">
            <label class="custom-control-label" for="_template">{{ __('Worksheets template') }}</label>
        </div>
    </div>
</div>
