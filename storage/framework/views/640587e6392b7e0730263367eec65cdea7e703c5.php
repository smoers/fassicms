<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e($title); ?>

            </div>
            <div class="card-body">
                <div class="d-flex flex-row justify-content-around">
                    <div><div class="form-group"></div><label for="select_Worksheets">Fiches de travail</label><select class="form-control form-control-sm" id="select_Worksheets"><option value="id">Identifiant</option><option value="number">Numéro</option><option value="date">Date</option><option value="remarks">Remarques client</option><option value="work">Travail effectué</option><option value="oil_filtered">Huile filtrée</option><option value="validated">Fiche de travail validée</option><option value="validated_date">Validated Date</option><option value="customer_id">Client</option><option value="crane_id">Grue</option><option value="created_at">Date de création</option><option value="updated_at">Date de mise à jour</option><option value="user_id">Utilisateur</option><option value="oil_replace">Huile remplacée (litre)</option><option value="warranty">Under warranty</option></select></div>
                    <div><div class="form-group"></div><label for="select_Customer">Client</label><select class="form-control form-control-sm" id="select_Customer"><option value="id">Identifiant</option><option value="name">Nom de la compagnie</option><option value="address">Adresse</option><option value="address_optional">Adresse (optionelle)</option><option value="city">Localité</option><option value="zipcode">Code postal</option><option value="country">Pays</option><option value="mail">Adresse email</option><option value="phone">Téléphone</option><option value="mobile">Mobile</option><option value="vat">TVA</option><option value="created_at">Date de création</option><option value="updated_at">Date de mise à jour</option><option value="user_id">Utilisateur</option></select></div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/moco/fassicms/resources/views/reporting/test.blade.php ENDPATH**/ ?>