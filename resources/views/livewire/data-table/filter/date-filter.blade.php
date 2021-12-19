<div class="d-sm-flex flex-sm-row">
    <input type="text" class="form-control form-control-sm" id="filter-date-{{$name}}" placeholder="{{__('DD/MM/YYYY')}}" aria-label="date" aria-describedby="basic-addon1" wire:model.debounce.2000ms="filters.{{$name}}"/>
    <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
    </div>
</div>
<script>
    $(function (){
        $('#filter-date-{{$name}}').datepicker({
            format: 'dd/mm/yyyy',
            orientation: 'bottom auto',
            language: 'fr',
            todayBtn: "linked",
            autoclose: true,
        }).on('changeDate',function(e){
            @this.set('filters.{{$name}}',moment(e.date).format('DD/MM/YYYY'));
        });
    })
</script>
