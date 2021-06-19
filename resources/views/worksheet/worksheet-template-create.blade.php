@extends('layouts.layout')

@section('content')
    <div class="container p-5 h-100 moco-layout-height" style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-around">
                    <div class="d-flex justify-content-center align-self-center">
                        <span class="align-self-center">{{__('Number of worksheet')}} :</span>
                        <span class="align-self-center"><input type="number" id="nbr" name="nbr" class="form-control ml-3" value="0"></span>
                    </div>
                    <div class="align-self-center"><a href="#" class="btn btn-danger" id="launch">{{__('Launch')}}</a></div>
                </div>
                <form name="template-form" id="template-form" method="post" action="{{route('worksheet.template.store')}}">
                    @csrf
                    <table class="table table-sm table-striped mt-5">
                        <tbody id="addRow">

                        </tbody>
                    </table>
                    <div hidden id="wait" class="text text-danger">{{__('Please wait ...')}}</div>
                    <div hidden class="d-flex justify-content-between save">
                        <div hidden class="save">
                            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                        </div>
                        <div hidden class="save">
                            <a href="{{ route('worksheet.index') }}" class="btn btn-primary">{{__('Cancel')}}</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script id="document-template" type="text/x-handlebars-template">
        <tr><td><input type="text" readonly class="form-control form-control-sm bg-white" name="number[]" value="@{{ number }}"/></td></tr>
    </script>
    <script type="text/javascript">
        /** constante avec la function permettant de générer un delai**/
        const delay = (n) => new Promise( r => setTimeout(r, n*1000));
        $(function () {
            /** tableau avec la liste des numéros de worksheet**/
            var _number_array = [];
            /** event sur le bouton launch **/
            $('#launch').on('click',async () => {
                /** récupère le nombre de worksheet number à créer **/
                let _nbr = parseInt($('#nbr').val());
                if (_nbr > 0) {
                    /** cache le bouton launch **/
                    $('#launch').attr('hidden','hidden');
                    /** affiche le message d'attente **/
                    $('#wait').removeAttr('hidden');
                    /** génère template pour la librairie Handlebars **/
                    let template = Handlebars.compile($('#document-template').html());
                    /** on boucle pour générer les numéros **/
                    for (let i = 1; i <= _nbr; i++) {
                        _number_array[i] = moment().format('YYYYMMDDHHmmss');
                        $('#addRow').append(template({number: _number_array[i]}));
                        await delay(2);
                    }
                    /** cache le message d'attente **/
                    $('#wait').attr('hidden','hidden');
                    $('.save').removeAttr('hidden');
                }
            });
        })
        /** permet de créer un moment d'attente **/
        async function wait(){
            await delay(2);
        }
    </script>
@endsection

