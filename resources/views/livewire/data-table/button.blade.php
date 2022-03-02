<div class="d-flex flex-row">
    <a href="#" class="btn btn-success moco-btn-sm mr-2" wire:click="cleanFilter"><i class="fas fa-trash"></i> {{__('Clear filter')}}</a>
    <a href="#" class="btn btn-danger moco-btn-sm mr-2" wire:click="export" id="export"><i class="fas fa-file-export"></i> {{__('Export to xls')}}</a>
    <button id="loading" class="btn btn-primary moco-btn-sm mr-2" style="display: none">
        <span class="spinner-border spinner-border-sm"></span>
        {{__('Loading ...')}}
    </button>
    @if($exporting)
        <a href="#" class="btn btn-success moco-btn-sm mr-2" wire:click="downloadExport"><i class="fas fa-file-export"></i> {{$name}}</a>
    @endif
</div>
<script type="text/javascript">
    $(function (){
        $('#export').on('click', function(){
           $('#loading').show();
        });
    })
</script>
