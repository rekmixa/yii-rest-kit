<?php

use yii\helpers\Html;
use \ii\web\View;
use yii\mail\MessageInterface;

/**
 * @var View $this
 * @var MessageInterface $message
 * @var string $content
 */
?>

<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?= $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
