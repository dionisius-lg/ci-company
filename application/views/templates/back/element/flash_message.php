<?php if (hasFlashSuccess()) { ?>
    <script type="text/javascript">
        $(document).ready(function() {
            toastr.success('<?php echo FlashSuccess(); ?>');
        });
    </script>
<?php } ?>

<?php if (hasFlashError()) { ?>
<script type="text/javascript">
    $(document).ready(function() {
        toastr.error('<?php echo FlashError(); ?>');
    });
</script>
<?php } ?>