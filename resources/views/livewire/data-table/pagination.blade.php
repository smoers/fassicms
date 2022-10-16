<div class="row">
    <div class="col @if($this->edit) disabled @endif">
        {{ $models->links() }}
    </div>

    <div class="col text-right text-muted">
        {{__('results', [
            'first' => $models->count() ? $models->firstItem() : 0,
            'last' => $models->count() ? $models->lastItem() : 0,
            'total' => $models->total()
        ])}}
    </div>
</div>
