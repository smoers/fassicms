<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height"  style="min-width: 50vw">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <h2 class="blue-grey-darker-hover"><?php echo e(__('Edit clocking')); ?></h2>
            </div>
            <div class="card-body">
                <form name="clocking-form" id="clocking-form" method="post" action="<?php echo e($action); ?>">
                    <div class="d-flex justify-content-between mb-5">
                        <div class="d-flex flex-row">
                            <div class="mr-2"><?php echo e(_('Date')); ?> :</div>
                            <div class="mr-2"><?php echo e($worksheet->date); ?></div>
                        </div>
                        <div class="d-flex flex-row">
                            <div class="mr-2"><?php echo e(_('Number')); ?> :</div>
                            <div class="mr-2 moco-color-error"><?php echo e($worksheet->number); ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Technician -->
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="technician_id"><?php echo e(__('Technician')); ?></label>
                                <select id="technician_id" name="technician_id" class="form-control form-control-sm">
                                    <option></option>
                                    <?php $__currentLoopData = $technicians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technician): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($technician->id); ?>"><?php echo e($technician->lastname.' '.$technician->firstname); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="start_date"><?php echo e(__('Start date')); ?></label>
                                <div class="input-group mb-3">
                                    <input type="text" id="start_date" name="start_date" class="form-control form-control-sm" placeholder="<?php echo e(__('DD/MM/YYYY')); ?>" aria-label="date" aria-describedby="basic-addon1" value=""/>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar-alt"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="start_time"><?php echo e(__('Start time')); ?></label>
                                <input type="time" id="start_time" name="start_time" class="form-control form-control-sm" placeholder="" value=""/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="stop_time"><?php echo e(__('Stop time')); ?></label>
                                <input type="time" id="stop_time" name="stop_time" class="form-control form-control-sm" placeholder="" value=""/>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="diff"><?php echo e(__('Difference')); ?></label>
                                <input type="time" id="diff" name="diff" readonly class="form-control form-control-sm bg-white" placeholder="" value=""/>
                            </div>
                        </div>
                        <div class="col-md-1" style="margin-top:35px;">
                            <a href="#" id="_add"><i class="fas fa-plus-circle fa-2x"></i> </a>
                        </div>
                    </div>
                    <table class="table table-sm table-striped" id="table_clocking">
                        <tbody id="addRow">
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>
                        </div>
                        <div>
                            <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary"><?php echo e(__('Cancel')); ?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script id="document-template" type="text/x-handlebars-template">
        <tr id="_delete">
            <td>
                <input type="hidden" name="technician_id[]" value="{{ technician_id }}"/>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm bg-white" readonly name="lastname[]" value="{{ lastname }}"/>
            </td>
            <td>
                <input type="text" class="form-control form-control-sm bg-white" readonly name="start_date[]" value="{{ start_date }}"/>
            </td>
            <td>
                <input type="time" class="form-control form-control-sm bg-white" readonly name="start_time[]" value="{{ start_time }}"/>
            </td>
            <td>
                <input type="time" class="form-control form-control-sm bg-white" readonly name="stop_time[]" value="{{ stop_time }}"/>
            </td>
            <td>
                <input type="time" class="form-control form-control-sm bg-white" readonly name="diff[]" value="{{ diff }}"/>
            </td>
            <td>
                <a href="#" id="_remove"><i class="fas fa-trash fa-2x" style="color: red !important;"></i></a>
            </td>
        </tr>
    </script>
    <script type="text/javascript">

        $(function () {

            $('#start_date').datepicker({
                format: 'dd/mm/yyyy',
                orientation: 'bottom auto',
                language: 'fr',
                todayBtn: "linked",
                autoclose: true,
            });

            $('#start_time').on('change', function () {
                setDiff(this);
            })

            $('#stop_time').on('change', function () {
                setDiff(this);
            })

            /*
            * Chargement du tableau
            */
            $('#_add').on('click', function () {
                if ($('#technician_id').val() != "" && $('#start_date').val() != "" && $('#start_time').val() != "" && $('#stop_time') != "") {
                    /*
                    * Récupère le texte du select
                    */
                    var select = document.getElementById("technician_id");
                    /*
                     * Chargement des valeurs
                     */
                    var technician_id = $('#technician_id').val();
                    var lastname = select.options[select.selectedIndex].text;
                    var start_date = $('#start_date').val();
                    var start_time = $('#start_time').val();
                    var stop_time = $('#stop_time').val();
                    var diff = $('#diff').val();
                    var source = $('#document-template').html();
                    var template = Handlebars.compile(source);
                    /*
                     * object pour le Handlebars
                    */
                    var data = {
                        technician_id: technician_id,
                        lastname: lastname,
                        start_date: start_date,
                        start_time: start_time,
                        stop_time: stop_time,
                        diff: diff
                    }
                    /*
                     *Charge les valeurs dans la nouvelle ligne
                     */
                    var html = template(data);
                    /*
                    * Affiche la nouvelle ligne
                    */
                    $('#addRow').append(html);
                    /*
                    * cleanup
                    */
                    $('#technician_id').val("");
                    $('#start_date').val("");
                    $('#start_time').val("");
                    $('#stop_time').val("");
                    $('#diff').val("");
                }
            })
            /**
             * Supprime une ligne du tableau
             */
            $(document).on('click', "#_remove", function (event) {
                $(this).closest("#_delete").remove();
            })


        })

        /*
        * Calul et affiche la différence
         */
        function setDiff(value) {
            let startTime = moment($('#start_time').val(), "HH:mm");
            let stopTime = moment($('#stop_time').val(), "HH:mm");
            if (startTime.isValid() && stopTime.isValid() && startTime.isBefore(stopTime)) {
                $('#diff').val(moment.utc(stopTime.diff(startTime)).format("HH:mm"));
            } else {
                $("#diff").val("");
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/worksheet/worksheet-clocking-form.blade.php ENDPATH**/ ?>