<div class="d-flex flex-row justify-content-start mb-3 ml-3" style="vertical-align: center">
    <div class="moco-color-info mr-2"><i class="fas fa-map-pin fa-2x"></i></div>
    <div>
        <select wire:model='locationId' id="location"  class="form-control moco-row-table-font-small" data-width="fit" title="{{__('Select a Location')}}">
            @foreach(App\Models\Location::all() as $location)
                <option value="{{$location->id}}" class="moco-row-table-font-small" >{{__($location->location)." : ".__($location->description)}}</option>
            @endforeach
        </select>
    </div>
</div>
