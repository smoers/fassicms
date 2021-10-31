<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        @include('livewire.data-table.thead')
        <tbody>
        @include('livewire.data-table.filter')

        @include('livewire.data-table.tbody')
        </tbody>
    </table>
    @include("livewire.data-table.pagination")
</div>
