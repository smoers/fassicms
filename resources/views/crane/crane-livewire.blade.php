<form wire:submit.prevent="validated" method="post">
    <div class="row ml-4">
        @if($mode['value'] >= 2 && $mode['value'] <= 4 || $mode['value'] == 6 )
            <p class="red-darker-hover"><i class="fas fa-exclamation-triangle"></i> : {{$mode['msg']}}</p>
        @elseif($mode['value'] == 1)
            <p class="blue-darker-hover"><i class="fas fa-edit"></i> : {{$mode['msg']}}</p>
        @elseif($mode['value'] == 5)
            <p class="green-darker-hover"><i class="fas fa-info-circle"></i> : {{$mode['msg']}}</p>
        @endif
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <div class="card">
                <div class="card-header moco-title-table">
                    <img src="/images/crane-32.png"> {{__('Crane')}}
                </div>
                <div class="card-body">
                    <input id="crane_id" name="crane_id" type="hidden" wire:model="crane_id">
                    <div class="form-group">
                        <label for="serial">{{ __('Serial number') }}</label>
                        <input type="text" list="listcranes" id="serial" name="serial" class="form-control form-control-sm" autocomplete="off" wire:model="serial">
                        <datalist id="listcranes">
                            @foreach($listCranes as $crane)
                                <option value="{{$crane->serial}}" label="{{$crane->serial}} : {{$crane->crane_model}}"/>
                            @endforeach
                        </datalist>
                        @error('serial')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="crane_model">{{ __('Model')  }}</label>
                        <input type="text" id="crane_model" name="crane_model" class="form-control form-control-sm" autocomplete="off" wire:model="crane_model"/>
                        @error('crane_model')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header moco-title-table"><img src="/images/customer-32.png"> {{__("Customer")}}</div>
                <div class="card-body">
                    <input id="customer_id" name="customer_id" type="hidden" value="" wire:model="customer_id">
                    <div class="form-group">
                        <label for="customer_name">{{ __('Company name') }}</label>
                        <input type="text" list="listcustomers" id="customer_name" name="customer_name" class="form-control form-control-sm" autocomplete="off" wire:model="customer_name">
                        <datalist id="listcustomers">
                            @foreach($listCustomers as $customer)
                                <option value="{{$customer->name}}" label="{{$customer->address}} {{$customer->city}}"/>
                            @endforeach
                        </datalist>
                        @error('customer_name')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-3">
            <div class="card">
                <div class="card-header moco-title-table">
                    <img src="/images/truck-32.png"> {{__('Truck')}}
                </div>
                <div class="card-body">
                    <input id="truck_id" name="truck_id" type="hidden" wire:model="truck_id">
                    <div class="form-group">
                        <label for="plate">{{ __('Numberplate') }}</label>
                        <input type="text" list="listtrucks" id="plate" name="plate" class="form-control form-control-sm" autocomplete="off" wire:model="plate">
                        <datalist id="listtrucks">
                            @foreach($listTrucks as $truck)
                                <option value="{{$truck->plate}}" label="{{$truck->plate}} : {{$truck->brand}} {{$truck->truck_model}}"/>
                            @endforeach
                        </datalist>
                        @error('plate')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="brand">{{ __('Brand')  }}</label>
                        <input type="text" id="brand" name="brand" class="form-control form-control-sm" autocomplete="off" wire:model="brand"/>
                        @error('brand')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="truck_model">{{ __('Model')  }}</label>
                        <input type="text" id="truck_model" name="truck_model" class="form-control form-control-sm" autocomplete="off" wire:model="truck_model"/>
                        @error('truck_model')<span class="moco-error-small moco-color-error">{{$message}}</span>@enderror
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <div>
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
        <div>
            <a href="{{ route('crane.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
        </div>
    </div>
    <div class="row" @if($hasHistoric == false) hidden @endif>
        <div class="col-12">
            <div class="card">
                <div class="card-header text-left">
                    {{__('History')}}
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead class="moco-title-table">
                        <tr>
                            <th></th>
                            <th>{{__('Serial Number')}}</th>
                            <th>{{__('Numberplate')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($histories as $history)
                            <tr>
                                <td><img src="/images/history-32.png"></td>
                                <td>{{$history->serial}}</td>
                                <td>{{$history->plate}}</td>
                                <td>{{$history->name}}</td>
                                <td>{{$history->date_current}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Message avant la sauvegarde -->
<div class="modal" id="modal_message" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid">
                    <div class="d-flex justify-content-sm-center align-items-center">
                        <p class="moco-color-error h4"><img src="/images/siren-48.png"> {{__('Attention')}}</p>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="moco-color-error moco" id="message"></div>
            </div>
            <div class="modal-footer">
                <div class="container-fluid">
                    <div class="d-flex justify-content-md-between">
                        <button type="button" id="saveModal" class="btn btn-danger" data-dismiss="modal">{{__('Save')}}</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">{{__('Cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function (){
        $('#customer_name').on('focusout',function (){
            Livewire.emit('eventCustomerNameFocusOut');
        })
        $('#saveModal').on('click',function (){
            Livewire.emit('save');
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
