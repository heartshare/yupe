<?php
    $this->breadcrumbs = array(
        Yii::app()->getModule('news')->getCategory() => array(),
        Yii::t('NewsModule.news', 'News') => array('/news/default/index'),
        $model->title => array('/news/default/view', 'id' => $model->id),
        Yii::t('NewsModule.news', 'Edit'),
    );

    $this->pageTitle = Yii::t('NewsModule.news', 'News - edit');

    $this->menu = array(
        array('icon' => 'list-alt', 'label' => Yii::t('NewsModule.news', 'News management'), 'url' => array('/news/default/index')),
        array('icon' => 'plus-sign', 'label' => Yii::t('NewsModule.news', 'Create article'), 'url' => array('/news/default/create')),
        array('label' => Yii::t('NewsModule.news', 'News Article') . ' «' . mb_substr($model->title, 0, 32) . '»'),
        array('icon' => 'pencil', 'label' => Yii::t('NewsModule.news', 'Edit news article'), 'url' => array(
            '/news/default/update/',
            'id' => $model->id
        )),
        array('icon' => 'eye-open', 'label' => Yii::t('NewsModule.news', 'View news article'), 'url' => array(
            '/news/default/view',
            'id' => $model->id
        )),
        array('icon' => 'trash', 'label' => Yii::t('NewsModule.news', 'Remove news'), 'url' => '#', 'linkOptions' => array(
            'submit' => array('/news/default/delete', 'id' => $model->id),
            'params' => array(Yii::app()->request->csrfTokenName => Yii::app()->request->csrfToken),
            'confirm' => Yii::t('NewsModule.news', 'Do you really want to remove the article?'),
            'csrf' => true,
        )),
    );
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('NewsModule.news', 'Edit news article'); ?><br />
        <small>&laquo;<?php echo $model->title; ?>&raquo;</small>
    </h1>
</div>

<?php echo $this->renderPartial('_form', array('model' => $model, 'languages' => $languages, 'langModels' => $langModels)); ?>
