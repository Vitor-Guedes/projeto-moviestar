<?php

try {
    $setup = file_get_contents(BASE_DIR . '/db.sql');

    $result = $connection->exec($setup);
} catch (Exception $e) {
    $result = 'Error Setup DB: ' . $e->getMessage();
}

?>

<?php if (is_string($result)) : ?>
    <p> <?= $result ?> </p>
<?php else : ?>
    <p> Setup Sucessful </p>
<?php endif ; ?>