<?php

use common\modules\image\widgets\main_image\MainImageWidget;
use common\modules\post\models\PostCategory;
use common\modules\user\models\User;
use kartik\sortable\Sortable;
use xvs32x\tinymce\Tinymce;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
/* @mixin common\modules\image\behaviors\ImageBehave */
?>

<?php $form = ActiveForm::begin(
    [
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ]); ?>

<div class="row">
    <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Загальне</a>
                </li>
                <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="image-tab" data-toggle="tab" aria-expanded="false">Зображення</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                    <p>
                        <div class="row">

                        <!--  Right col  -->
                        <div class="form-group col-sm-8 col-xs-12">
                            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($model, 'content')->widget(Tinymce::class, [
                                //TinyMCE options
                                'pluginOptions' => [
                                    'setup' => new JsExpression("function(editor){
                                        editor.on('change', function () {
                                        editor.save();
                                    });
                                }"),
                                    'plugins' => [
                                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                                        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                                        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
                                    ],
                                    'min_height' => 230,
                                    'advlist_bullet_styles' => 'disc circle',
                                    'advlist_number_styles' => 'lower-alpha',
                                    'paste_as_text' => true,
                                    'menubar' => false,
                                    'toolbar1' => "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link unlink | image media | code preview",
                                    'image_advtab' => true,
                                    'filemanager_title' => "Менеджер файлів",
                                    'language' => (Yii::$app->language != 'uk_UA') ? 'uk_UA' : 'en_GB',
                                ],
                                //Widget Options
                                'fileManagerOptions' => [
                                    'configPath' => [
                                        'upload_dir' => '/uploads/filemanager/original/',
                                        'current_path' => '../../../../../public_html/uploads/filemanager/original/',
                                        'thumbs_base_path' => 'uploads/filemanager/thumb/',
                                        'base_url' => Yii::$app->request->hostInfo, // <-- uploads/filemanager path must be saved in frontend
                                    ]
                                ]
                            ])->label('Текст')?>

                            <div class="row">
                                <div class="form-group col-md-4 col-xs-12">
                                    <?= $form->field($model, 'category_id')->dropDownList(PostCategory::buildTreeDropDown(), ['prompt' => 'Без категорії...']) ?>
                                </div>

                                <div class="form-group col-xs-12">
                                    <?= $form->field($model, 'status')->checkbox(['class' => 'js-switch']) ?>
                                </div>
                            </div>

                        </div>
                        <!--  end Right col  -->

                        <!--  Left col  -->
                        <div class="form-group col-sm-4 col-xs-12">
                            <? try {
                                echo MainImageWidget::widget([
                                    'form' => $form,
                                    'model' => $model,
                                ]);
                            } catch (Exception $e) {
                                Yii::error($e);
                            } ?>

                            <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'placeholder' => 'Якщо не вказати, заповниться автоматично']) ?>

                            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

                            <?= $form->field($model, 'author_id')->dropDownList(User::listAll()) ?>

                        </div>
                        <!--  end Left col  -->

                    </div>
                    </p>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="image-tab">
                    <p>

                        <label class="control-label" for="post-content">Галерея</label>
                        <div class="x_title"></div>
                        <div class="col-xs-12">
                            <div class="row files" id="gallery-files">
                    <span class="btn btn-success btn-sm btn-file">
                       <i class="fa fa-image"></i> Додати фото   <?= $form->field($model, 'images[]',['template' => "{label}{input}"])->fileInput(['id' => 'fileInputId','multiple' => true, 'accept' => 'image/*'])->label(false) ?>
                    </span>
                                <button
                                        class="btn btn-danger btn-sm pull-right"
                                        style="margin-right: 5px;"
                                        type="button"
                                        title= 'Видалити всі зображення з галереї'
                                        onclick="deleteAllImages('<?= Url::toRoute(['/post/del-all-images'])?>',<?= $model->id ?>)"><i class="fa fa-trash-o"></i> Видалити всі зображення
                                </button>
                                <button
                                        class="btn btn-default btn-sm pull-right removeAllFile"
                                        style="margin-right: 5px;"
                                        type="button"
                                        title= 'Видалити всі зображення з черги на завантаження'>
                                    <i class="fa fa-eraser"></i> Очистити чергу завантаження
                                </button>
                                <br />
                                <ul class="list-group list-group-flush fileList"></ul>
                            </div>
                            <?= $form->errorSummary($model, ['class' => 'text-danger']) ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <? if ($items = $model->getGalleryItems()): ?>
                                    <? try {
                                        echo Sortable::widget([
                                            'type'=>'grid',
                                            'items' => $items,
                                            'pluginEvents' => [
                                                'sortupdate' => 'function(e) {imageSorting (e,"'. Url::toRoute(['sorting-images']) .'", '.$model->id.')}'
                                            ],
                                        ]);
                                    } catch (Exception $e) {
                                        Yii::error($e);
                                    } ?>
                                <? endif; ?>
                            </div>
                        </div>
                    </p>
                </div>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>

    <div class="form-group col-sm-offset-5 col-sm-2 col-xs-12">
        <?= Html::submitButton('<i class="fa fa-floppy-o"></i> Зберегти', ['class' => 'btn btn-block btn-success']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
