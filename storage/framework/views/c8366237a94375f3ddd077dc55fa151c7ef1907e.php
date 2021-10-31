

<?php $__env->startSection('content'); ?>
    <div class="container p-5 h-100 moco-layout-height">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                <?php echo e($title); ?>

            </div>
            <div class="card-body">
                <select class="form-control form-control-sm">
            <option value="id">Identifiant</option>
            <option value="number">Numéro</option>
            <option value="date">Date</option>
            <option value="remarks">Remarques client</option>
            <option value="work">Travail effectué</option>
            <option value="oil_filtered">Huile filtrée</option>
            <option value="validated">Fiche de travail validée</option>
            <option value="validated_date">Validated Date</option>
            <option value="customer_id">Client</option>
            <option value="crane_id">Grue</option>
            <option value="created_at">Date de création</option>
            <option value="updated_at">Date de mise à jour</option>
            <option value="user_id">Utilisateur</option>
            <option value="oil_replace">Huile remplacée (litre)</option>
            <option value="warranty">Under warranty</option>
    </select>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/moco/fassicms/resources/views/reporting/select.blade.php ENDPATH**/ ?>