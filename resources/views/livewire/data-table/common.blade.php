<script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.fr.min.js')}}"></script>
<script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.nl-BE.min.js')}}"></script>
<script src="{{ asset('3rd/resizable-table-columns-2.0.5/js/bundle/index.min.js')}}"></script>
<script type="text/javascript">
    $(function () {
        /*** Initie la classe de resizing des colonnes ***/
        var els = document.querySelector('table.data');
        new window.validide_resizableTableColumns.ResizableTableColumns(els,null);
        /*** Event lors du changement de page au travers de Livewire ***/
        /*** lié à $this->dispatchBrowserEvent('resizable'); ***/
        window.addEventListener('resizable', event => {
            var els = document.querySelector('table.data');
            new window.validide_resizableTableColumns.ResizableTableColumns(els,null);
        })

    });
</script>

