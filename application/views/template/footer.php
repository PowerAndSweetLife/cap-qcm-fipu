<script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/all.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/sweetalert2.min.js"></script>
<script src="<?php echo base_url(); ?>public/js/app.js"></script>

<?php if (isset($revision)) : ?>
    <script src="<?php echo base_url(); ?>public/js/revision.js"></script>
<?php endif; ?>
<?php if (isset($active)) : ?>
    <script src="<?php echo base_url(); ?>public/js/plotly.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/app_begin.js"></script>
    <script src="<?php echo base_url(); ?>public/js/app_plotly.js"></script>
    <script src="<?php echo base_url(); ?>public/js/loader.js"></script>
<?php endif; ?>

<?php if (isset($timer)) : ?>
    <script src="<?php echo base_url(); ?>public/js/plotly.min.js"></script>
    <script src="<?php echo base_url(); ?>public/js/timer.js"></script>
    <script src="<?php echo base_url(); ?>public/js/app_plotly.js"></script>
<?php endif; ?>


<?php if (isset($design)) : ?>
    <script src="<?php echo base_url(); ?>public/js/design.js"></script>
<?php endif; ?>


<?php if (isset($favoris_not_exist)) : ?>
    <script>
        Swal.fire(
            'Erreur !',
            'La section révision est vide !',
            'warning'
        )
    </script>
<?php endif; ?>

<?php if (isset($error_must_pay)) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Serveur saturé, revenez plus tard !',
            // footer: '<a href="">Why do I have this issue?</a>'
        })
    </script>
<?php endif; ?>

</body>

</html>