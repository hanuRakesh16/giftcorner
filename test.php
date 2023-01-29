<pre>
    <?php
    print_r($_SERVER);
    $__site_config_path = dirname($_SERVER['DOCUMENT_ROOT']) . '/giftcorner.json';
    echo ($__site_config_path);
    $__site_config = file_get_contents($__site_config_path);
    echo ($__site_config);
    $array = json_decode($__site_config);
    echo($array['db_name']);
    ?>
</pre>