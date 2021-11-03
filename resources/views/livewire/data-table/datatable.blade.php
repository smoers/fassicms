<div class="table-responsive">
    <div class="d-flex flex-row justify-content-between mb-1">
        @include('livewire.data-table.perpage')
        @include('livewire.data-table.button')
    </div>
    <table class="table table-sm table-striped table-bordered">
        @include('livewire.data-table.thead')
        <tbody>
        @include('livewire.data-table.filter')

        @include('livewire.data-table.tbody')
        </tbody>
    </table>
    @include("livewire.data-table.pagination")
</div>
