<div id="change_password_modal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex justify-content-center" style="width: 100%">
                    {{__('Change your password')}}
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="current_password">{{__('Current password')}}</label>
                    <input type="password" class="form-control" id="current_password"/>
                    <div class="moco-error-small danger-darker-hover" id="current_password_Error"></div>
                </div>
                <div class="form-group">
                    <label for="new_password">{{__('New password')}}</label>
                    <input type="password" class="form-control" id="new_password"/>
                    <div class="moco-error-small danger-darker-hover" id="new_password_Error"></div>
                    <div id="format" hidden>
                        <div class="d-flex flex-column mt-2" id="format_msg" style="font-size: 11px"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirm_password">{{__('Confirm new password')}}</label>
                    <input type="password" class="form-control" id="confirm_password"/>
                    <div class="moco-error-small danger-darker-hover" id="confirm_password_Error"></div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-between" style="width: 100%">
                    <div>
                        <a href="#" class="btn btn-primary" id="validate">{{__('Validate')}}</a>
                    </div>
                    <div>
                        <a href="#" class="btn btn-primary" id="cancel">{{__('Cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function (){
        var _url_check_current_password = '{{route('password.checkcurrent')}}';
        var _url_check_format_password = '{{route('password.format')}}';
        var _url_change_password = '{{route('password.store')}}';
        /** ajax setup **/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            dataType: "json",
            async: true,
        });
        /** affiche la fenêtre modal pour le changement du mot de passe **/
        $('#change_password').on('click',() =>{
            $('#change_password_modal').modal('show');
            $('#current_password').focus();
        });
        /** cache la fenêtre modal par un click sur le bouton cancel**/
        $('#cancel').on('click', () => {
            $('#change_password_modal').modal('hide');
        });
        /** controlle le mot de passe actuel **/
        $('#current_password').on('change', function (){
            requestCPassword({password: $(this).val()}, _url_check_current_password).then((result) => {
                if (result.checked){
                    isValid('#current_password');
                } else {
                    isInValid('#current_password',result.msg);
                }
            });
        });
        /** controle le format du mot de passe du champ nouveau lot de passe **/
        $('#new_password').on('keyup',function (){
            requestCPassword({password: $(this).val()}, _url_check_format_password).then((result => { applyResult(result); }));
        }).on('focusin',function(){
            requestCPassword({password: $('#new_password').val()}, _url_check_format_password).then((result => { applyResult(result); }));
        }).on('focusout', () => {
            $('#format').attr('hidden','hidden');
        });

        /** controle que la valeur du champ confirmation correspond au nouveau mot de passe **/
        $('#confirm_password').on('keyup',function () {
            if ($(this).val() != "" && $(this).val() != $('#new_password').val()){
                isInValid('#new_password',' ');
                isInValid('#confirm_password','{{__('The value not match with the new password')}}');
            } else {
                isValid('#new_password');
                isValid('#confirm_password');
            }
        });
        /** action pour sauvegarder le nouveau mote de passe **/
        $('#validate').on('click', () => {
            /** avant de lancer la requête ajax on check pour savoir s'il y a des champs vides **/
            if ($('#current_password').val() == ''){
                $('#current_password').focus();
            }else if ($('#new_password').val() == ''){
                $('#new_password').focus();
            }else if ($('#confirm_password').val() == ''){
                $('#confirm_password').focus();
            }else {
                /** requête Ajax **/
                let data = {
                    current_password: $('#current_password').val(),
                    new_password: $('#new_password').val(),
                    confirm_password: $('#confirm_password').val()
                };
                requestCPassword(data, _url_change_password).then((result) => {
                    if (result.checked){
                        /** Le mot d passe a été changé **/
                        iziToast.success({
                            title: '{{__('Success')}}',
                            message: result.msg,
                            timeout: 10000,
                        });
                        $('#change_password_modal').modal('hide');
                    } else {
                        iziToast.error({
                            title: '{{__('Error')}}',
                            message: result.msg,
                            timeout: 10000,
                        });
                        /** le mot de passe n'a pas été changé, on donne le focus au premier champ en erreur **/
                        if (result.current){
                            $('#current_password').focus();
                        }else if (result.password){
                            $('#new_password').focus();
                        }else if (result.confirm){
                            $('#confirm_password').focus();
                        }
                    }
                })
            }
        });

    });

    /**
     * format du champ si valide
     */
    function isValid(selector){
        $(selector).removeClass('is-invalid').addClass('is-valid');
        $(selector+'_Error').text("");
    };

    function isInValid(selector,message){
        if(message == null)
        {
            $(selector).removeClass('is-invalid').addClass('is-valid');
            $(selector+'_Error').text("");
        }
        else
        {
            $(selector).removeClass('is-valid').addClass('is-invalid');
            $(selector + '_Error').text(message);
        }
    }

    /**
     *
     **/
    function applyResult(result){
        let format_msg = '';
        let checked = true;
        result.forEach((item) => {
           format_msg = format_msg + item.msg;
           checked = (checked == item.checked && checked == true);
        });
        $('#format_msg').html(format_msg);
        $('#format').removeAttr('hidden');
        if (checked){
            isValid('#new_password');
        } else {
            isInValid('#new_password','');
        }
    }

    /**
     * Requête ajax
     * @param data
     * @param url
     * @returns {Promise<*>}
     */
    async function requestCPassword(data, url){
        const _get =  await $.ajax({
            url: url,
            data: data,
        })
        return _get;
    }
</script>
