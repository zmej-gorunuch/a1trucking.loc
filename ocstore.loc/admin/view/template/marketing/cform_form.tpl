<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-coupon" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
        <h1><?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
          <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <div class="container-fluid">
      <?php if ($error_warning) { ?>
      <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
      </div>
      <?php } ?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
        </div>
        <div class="panel-body">
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cform" class="form-horizontal">
            <div class="tab-content">
              <div class="tab-pane active" id="tab-general">
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-cform_email"><?php echo $entry_cform_email; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="cform_email" value="<?php echo $cform_email; ?>" placeholder="<?php echo $entry_cform_email; ?>" id="input-cform_email" class="form-control" />
                    <?php if ($error_cform_email) { ?>
                    <div class="text-danger"><?php echo $error_cform_email; ?></div>
                    <?php } ?>
                  </div>
                  <input type="hidden" name="subscribe_date" value="<?php echo $subscribe_date; ?>" />
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-cform_name"><?php echo $entry_cform_name; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="cform_name" value="<?php echo $cform_name; ?>" placeholder="<?php echo $entry_cform_name; ?>" id="input-cform_name" class="form-control" />
                  </div>
                </div>
                <div class="form-group required">
                  <label class="col-sm-2 control-label" for="input-cform_phone"><?php echo $entry_cform_phone; ?></label>
                  <div class="col-sm-10">
                    <input type="text" name="cform_phone" value="<?php echo $cform_phone; ?>" placeholder="<?php echo $entry_cform_phone; ?>" id="input-cform_phone" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php echo $footer; ?>