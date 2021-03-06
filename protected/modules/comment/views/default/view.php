<?php
    $this->breadcrumbs = array(
        Yii::app()->getModule('comment')->getCategory() => array(),
        Yii::t('CommentModule.comment', 'Comments') => array('/comment/default/index'),
        $model->id,
    );

    $this->pageTitle = Yii::t('CommentModule.comment', 'Comments - show');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t('CommentModule.comment', 'Manage comments'), 'url' => array('/comment/default/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('CommentModule.comment', 'Create comment'), 'url' => array('/comment/default/create')),
        array('label' => Yii::t('CommentModule.comment', 'Comment') . ' «' . mb_substr($model->id, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('CommentModule.comment', 'Edit comment'), 'url' => array(
            '/comment/default/update',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('CommentModule.comment', 'View comment'), 'url' => array(
            '/comment/default/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('CommentModule.comment', 'Delete comment'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/comment/default/delete', 'id' => $model->id),
            'params' => array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
            'confirm' => Yii::t('CommentModule.comment', 'Do you really want do remove comment?'),
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('CommentModule.comment', 'Show comment'); ?><br />
        <small>&laquo;<?php echo $model->id; ?>&raquo;</small>
    </h1>
</div>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'       => $model,
    'attributes' => array(
        'id',
        'model',
        'model_id',
        array(
            'name'  => 'creation_date',
            'value' => Yii::app()->getDateFormatter()->formatDateTime($model->creation_date, "short", "short"),
        ),
        'name',
        'email',
        'url',
        'text',
        array(
            'name'  => 'status',
            'value' => $model->getStatus(),
        ),
        'ip',
    ),
)); ?>
