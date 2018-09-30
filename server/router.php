<?php

// If the requested URI is a readable file...
$file = __DIR__ . '/../public_html' . $_SERVER['REQUEST_URI'];
if (!is_dir($file) && is_readable($file)) {
    include($file);
    return true;
}

// Otherwise, if it's not a directory, return 404...
$directory = rtrim(__DIR__ . '/../public_html' . $_SERVER['REQUEST_URI'], '/') . '/';
if (!is_dir($directory)) {
    return false;
}

// Check if there's an index file...
$indexes = ['index.htm', 'index.html', 'index.php'];
foreach ($indexes as $index) {
    $file = $directory . $index;
    if (is_readable($file)) {
        include($file);
        return true;
    }
}

// Otherwise, list files...
$folder = rtrim($_SERVER['REQUEST_URI'], '/');
$files = glob($directory . '/*');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>

<head>
    <title>Index of
        <?= $folder ?>
    </title>
</head>

<body>
    <h1>Index of <?= $folder ?></h1>
    <table>
        <tr>
            <th valign="top">&nbsp;</th>
            <th>Name</th>
            <th>Last modified</th>
            <th>Size</th>
            <th>Description</th>
        </tr>
        <tr>
            <th colspan="5">
                <hr>
            </th>
        </tr>
        <?php if (strlen($folder) > 1) : ?>
            <tr>
                <td valign="top">&nbsp;</td>
                <td><a href="<?= dirname($folder); ?>">Parent Directory</a> </td>
                <td>&nbsp;</td>
                <td align="right"> - </td>
                <td>&nbsp;</td>
            </tr>
        <?php endif; ?>

        <?php if (empty($files)) : ?>

            <?php if (strlen($folder) > 1) : ?>
                <tr>
                    <th colspan="5">
                        <hr>
                    </th>
                </tr>
            <?php endif; ?>

            <tr>
                <th colspan="5">No file found!</th>
            </tr>

        <?php endif; ?>

        <?php foreach ($files as $file) : ?>
            <tr>
                <td valign="top">&nbsp;</td>
                <td>
                    <a href="<?= $folder; ?>/<?= basename($file); ?>">
                        <?= basename($file); ?>
                    </a>
                </td>
                <td align="right">
                    <?= date('Y-m-d H:i', filemtime($file)); ?>
                </td>
                <td align="right">
                    <?= filesize($file); ?>
                </td>
                <td>&nbsp;</td>
            </tr>
            <?php endforeach; ?>

            <tr>
                <th colspan="5">
                    <hr>
                </th>
            </tr>

    </table>

</body>
</html>
