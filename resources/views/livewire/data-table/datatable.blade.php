<article>
    <div class="container-fluid text-center mb-3">
        <div class="moco-title brown-lighter-hover">{{$title}}</div>
    </div>

    <div class="d-flex flex-row justify-content-between mb-1">
        @include('livewire.data-table.perpage')
        @include('livewire.data-table.button')
    </div>
    <table class="data table table-sm table-striped table-bordered" style="white-space: nowrap" data-rtc-resizable-table="table.one">
        @include('livewire.data-table.thead')
        <tbody>
        @include('livewire.data-table.filter')

        @include('livewire.data-table.tbody')
        </tbody>
    </table>
    @include("livewire.data-table.pagination")
</article>
@include("livewire.data-table.common")
