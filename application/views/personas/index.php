<?php
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />

<?php endforeach; ?>
<?php foreach($js_files as $file): ?>

    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<?php
/**
 * Created by PhpStorm.
 * User: Ricardo
 * Date: 3/16/14
 * Time: 8:17 AM
 */
echo $output;