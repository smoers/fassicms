        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ __('Add a part') }}</h2>
            </div>
            <div class="card-body">
                <form name="part-form" id="part-form" method="post" action="{{route('store.store')}}">
                @csrf
                <!-- Part Number-->
                    <div class="form-group">
                        <label for="part_number">{{ __('Part Number') }}</label>
                        <input wire:model="part_number" type="text" id="part_number" name="part_number" class="form-control" value="{{ $part_number }}">
                        @error('part_number') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                    </div>
                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">{{ __('Description')  }}</label>
                        <input wire:model="description" type="text" id="description "name="description" class="form-control" value="{{old('description')}}"></input>
                        @error('description') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                    </div>
                    <!-- Sur une ligne-->
                    <div class="row">
                        <!-- Quantity -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="qty">{{ __('Quantity')  }}</label>
                                <input wire:model="qty" type="number" id="qty "name="qty" class="form-control" value="{{old('qty')}}"></input>
                                @error('qty') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                            </div>
                        </div>
                        <!-- Location -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="location">{{ __('Location')  }}</label>
                                <input wire:model="location" type="text" id="location "name="location" class="form-control" value="{{old('location')}}"></input>
                                @error('location') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="price">{{ __('Price')  }}</label>
                                <input wire:model="price" type="text" id="price "name="price" class="form-control" value="{{old('price')}}"></input>
                                @error('price') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                            </div>
                        </div>
                        <!-- Year -->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="year">{{ __('Year')  }}</label>
                                <input wire:model="year" type="number" id="year "name="year" class="form-control" value="{{ $year }}" readonly="readonly"></input>
                                @error('year') <span class="red-darker-hover moco-error-small"><i class="fas fa-exclamation-triangle"></i>  {{ __($message) }}</span> @enderror
                            </div>
                        </div>

                    </div>
                    <div wire:ignore class="row">
                        <div class="col-10">
                            <!-- Provider -->
                            <div class="form-group">
                                <label for="provider">{{ __('Provider')  }}</label>
                                <select id="provider" name="provider" class="selectpicker form-control" data-live-search="true" title="{{__('Select a provider')}}">
                                    @foreach($providers as $_provider)
                                        <option value="{{$_provider->id}}">{{$_provider->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <!-- Enabled -->
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="enabled">{{ __('Enabled')  }}</label>
                                    <select @if(isset($enabled)) @if(!is_null($enabled)) readonly @endif @endif id="enabled" name="enabled" class="selectpicker form-control" data-width="fit" data-style="btn-primary">
                                        <option value="true" @if(isset($enabled)) @if($enabled == 'Yes') selected @endif @endif>{{__('Yes')}}</option>
                                        <option value="false" @if(isset($enabled)) @if($enabled == 'No') selected @endif @endif>{{__('No')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div class="col-10">
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
