<div>
    <div class="d-flex flex-column">
        <div class="moco-title">Test</div>
        <div>
            <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    @foreach($heads as $table => $head)
                        @foreach($head as $item)
                            <th>{{__($item)}}</th>
                        @endforeach
                    @endforeach
                </thead>
                <tbody>
                @foreach($worksheets as $worksheet)
                    <tr>
                        <td>{{$worksheet->id}}</td>
                        <td>{{$worksheet->description}}</td>
                        <td>{{$worksheet->created_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
            {{$worksheets->links()}}
        </div>
    </div>
</div>
