<form wire:submit.prevent="save" method="post">
    @csrf
    <div class="row">
        <div class="col-3">
            <!-- Date -->
            <div class="form-group">
                <label for="date">{{__('Date')}}</label>
                <div class="input-group mb-3">
                    <input type="text" id="date" name="date" class="form-control form-control-sm" placeholder="{{__('DD/MM/YYYY')}}" aria-label="date" aria-describedby="basic-addon1" wire:model.debounce.2000ms="worksheet.date"/>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                    </div>
                </div>
                @error('worksheet.date')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-2">
            <!-- Number -->
            <div class="form-group">
                <label for="number">{{__('Number')}}</label>
                <input type="text" id="number" name="number" class="form-control form-control-sm" value="" readonly wire:model="worksheet.number"/>
            </div>
        </div>
        <div class="col-2">
            <!-- Warranty -->
            <div class="form-group">
                <label for="warranty">{{ __('Warranty')  }}</label>
                <select id="warranty" name="warranty" class="form-control form-control-sm" wire:model="warranty">
                    <option value="1">{{__('Yes')}}</option>
                    <option value="0">{{__('No')}}</option>
                </select>
                @error('worksheet.warranty')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-2">
            <!-- Validated -->
            <div class="form-group">
                <label for="validated">{{ __('Validated')  }}</label>
                <select id="validated" name="validated" class="form-control form-control-sm" wire:model="validated">
                    <option value="1" >{{__('Yes')}}</option>
                    <option value="0" >{{__('No')}}</option>
                </select>
                @error('worksheet.validated')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
            </div>
        </div>
        <div class="col-3">
            <!-- Validated date -->
            <div class="form-group">
                <label for="validated_date">{{__('Validated date')}}</label>
                <input type="text" id="validated_date" name="validated_date" class="form-control form-control-sm" value="" readonly wire:model="validated_date"/>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#general" class="nav-link @if($tab_general) active @endif" data-toggle="tab" wire:click="setTab">{{__('General data')}}</a>
            </li>
            <li class="nav-item">
                <a href="#data" class="nav-link @if($tab_data) active @endif" data-toggle="tab" wire:click="setTab">{{__('Data')}}</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <!-- TAB GENERAL-->
            <div class="tab-pane fade @if($tab_general) show active @endif" id="general">
                <div class="row">

                    <!-- Search -->
                    <div class="col-6">
                        <div class="form-group">
                            <label for="searchCrane">{{__('Search crane')}} <a href="#" id="add_crane" wire:click="addTrucksCrane"><img src={{asset('/images/crane-24.png')}}/></a> </label>
                            <input id="searchCrane" name="searchCrane" class="form-control form-control-sm" placeholder="{{__('Search ...')}}" autocomplete="off" wire:model="searchCrane"/>
                            <div class="position-absolute mt-1" style="border-radius: 4px; border: lightgray 1px solid;z-index: 9999; height: 300px; width: 475px; background-color: white; overflow: auto; padding: 10px" @if(count($search) == 0) hidden @endif>
                                @foreach($search as $item)
                                    <div class="card mb-2 p-2" style="font-size: 9px;">
                                        <div class="d-flex d-sm-flex flex-sm-column">
                                            <div class="row">
                                                <div class="col-sm-10 border-right">
                                                    <div class="red-lighter-hover font-weight-bold">{{$item->serial}}</div>
                                                    <div>{{$item->crane_model}} - {{$item->plate}}</div>
                                                    <div>{{$item->name}} - {{$item->address}}</div>
                                                    <div>{{$item->zipcode}} - {{$item->city}} - {{$item->country}}</div>
                                                </div>
                                                <div class="col-sm-2 d-flex d-sm-flex align-items-center"><a href="#" wire:click="getTruckCrane({{$item->tc_id}})"><i class="fas fa-edit fa-2x" style="color: darkblue !important;"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="moco-error-small danger-darker-hover" id="crane_idError">
                            </div>
                        </div>
                    </div>

                    <!-- TrucksCrane -->
                    <div class="col-6">
                        <div class="form-group">
                            <label>{{__('Crane')}} <a href="#" id="add_crane" wire:click="addTrucksCrane"><img src={{asset('/images/crane-24.png')}}/></a> </label>
                            <input type="number" hidden wire:model="worksheet.truckscrane.id"/>
                            @if(is_null($truckscrane))
                                <div class="card" style="height: 200px">
                                    <div class="card-body" id="cardBody">
                                        <p style="color: lightgray">{{__('No crane selected')}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="card mb-2 p-2" style="font-size: 12px; cursor:pointer">
                                    <div class="d-flex d-sm-flex flex-sm-column">
                                        <div class="row">
                                            <div class="col-sm-10 border-right">
                                                <div class="red-lighter-hover font-weight-bold">{{$truckscrane->serial}}  </div>
                                                <div>{{$truckscrane->crane_model}}</div>
                                                <div>{{$truckscrane->plate}} - {{$truckscrane->brand}} - {{$truckscrane->truck_model}}</div>
                                                <div class="red-lighter-hover font-weight-bold">{{$customer->name}}</div>
                                                <div>{{$customer->address}}</div>
                                                <div>{{$customer->zipcode}} - {{$customer->city}} - {{$customer->country}}</div>
                                            </div>
                                            <div class="col-sm-2 d-flex d-sm-flex align-items-center"><a href="#" wire:click="removeTruckCrane()"><i class="fas fa-trash fa-2x" style="color: darkred !important;"></i></a></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @error('worksheet.truckscrane_id')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB DATA -->

            <div class="tab-pane fade @if($tab_data) show active @endif" id="data">

                <!-- Remarks -->
                <div class="form-group">
                    <label for="remarks">{{__('Customer remarks')}}</label>
                    <textarea id="remarks" name="remarks" rows="5" autocomplete="off" class="form-control form-control-sm" wire:model="worksheet.remarks"></textarea>
                </div>

                <!-- Work -->
                <div class="form-group">
                    <label for="work">{{__('Work done')}}</label>
                    <textarea id="work" name="work" rows="5" autocomplete="off" class="form-control form-control-sm" wire:model="worksheet.work"></textarea>
                </div>

                <div class="row">
                    <div class="col-4">

                        <!-- Oil replace -->
                        <div class="form-group">
                            <label for="oil_replace">{{__('Oil replaced (liter)')}}</label>
                            <input type="text" id="oil_replace" name="oil_replace" class="form-control form-control-sm" wire:model.debounce.5000ms="worksheet.oil_replace">
                            @error('worksheet.oil_replace')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-2">

                        <!-- Oil filtered -->
                        <div class="form-group">
                            <label for="oil_filtered">{{ __('Oil filtered')  }}</label>
                            <select id="oil_filtered" name="oil_filtered" class="form-control form-control-sm" wire:model="oil_filtered">
                                <option value="1">{{__('Yes')}}</option>
                                <option value="0">{{__('No')}}</option>
                            </select>
                            @error('worksheet.oil_filtered')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('worksheet.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
        </div>
    </div>
</form>

<script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.fr.min.js')}}"></script>
<script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.nl-BE.min.js')}}"></script>

<script type="text/javascript">
    $(function () {
        var fields = [
            'number',
            'date',
            'crane_id',
            'customer_id',
            'serial',
            'model',
            'plate',
            'name',
            'address',
            'phone',
            'mail',
            'vat',
            'remarks',
            'work',
            'oil_replace',
            'oil_filtered',
            'warranty',
        ];

        $('#searchCrane').on('focusout', function () {
            Livewire.emit('eventSearchCraneFocusOut');
        })

        $('#date').datepicker({
            format: 'dd/mm/yyyy',
            orientation: 'bottom auto',
            language: 'fr',
            todayBtn: "linked",
            autoclose: true,
        }).on('changeDate',(event) => {
            livewire.emit('eventDatePickerChange',moment(event.date).format('DD/MM/YYYY'));
            //console.log(moment(event.date).format('DD/MM/YYYY'));
        });
    })
</script>

