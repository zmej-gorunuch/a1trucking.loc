<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-coupon').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
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
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-coupon">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php if ($sort == 'contact_form_id') { ?>
                    <a href="<?php echo $sort_contact_form_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_contact_form_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_contact_form_id; ?>"><?php echo $column_contact_form_id; ?></a>
                    <?php } ?></td>
					<td class="text-left"><?php if ($sort == 'contact_form_name') { ?>
						<a href="<?php echo $sort_contact_form_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_contact_form_name; ?></a>
						<?php } else { ?>
						<a href="<?php echo $sort_contact_form_name; ?>"><?php echo $column_contact_form_name; ?></a>
						<?php } ?></td>
                    <td class="text-left"><?php if ($sort == 'contact_form_email') { ?>
                      <a href="<?php echo $sort_contact_form_email; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_contact_form_email; ?></a>
                      <?php } else { ?>
                      <a href="<?php echo $sort_contact_form_email; ?>"><?php echo $column_contact_form_email; ?></a>
                      <?php } ?></td>
					<td class="text-left"><?php echo $column_contact_form_message; ?></td>
                      <td class="text-left"><?php if ($sort == 'contact_form_date') { ?>
                        <a href="<?php echo $sort_contact_form_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_contact_form_date; ?></a>
                        <?php } else { ?>
                        <a href="<?php echo $sort_contact_form_date; ?>"><?php echo $column_contact_form_date; ?></a>
                        <?php } ?></td>
                        <td class="text-center"><?php echo $column_action; ?></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if ($contact_form) { ?>
                      <?php foreach ($contact_form as $contact_form) { ?>
                      <tr>
                        <td class="text-center"><?php if (in_array($contact_form['contact_form_id'], $selected)) { ?>
                          <input type="checkbox" name="selected[]" value="<?php echo $contact_form['contact_form_id']; ?>" checked="checked" />
                          <?php } else { ?>
                          <input type="checkbox" name="selected[]" value="<?php echo $contact_form['contact_form_id']; ?>" />
                          <?php } ?></td>
                          <td class="text-center"><?php echo $contact_form['contact_form_id']; ?></td>
						  <td class="text-left"><?php echo $contact_form['contact_form_name']; ?></td>
                          <td class="text-left"><?php echo $contact_form['contact_form_email']; ?></td>
                          <td class="text-left"><?php echo $contact_form['contact_form_message']; ?></td>
                          <td class="text-left"><?php echo $contact_form['contact_form_date']; ?></td>
                          <td class="text-center"><a href="<?php echo $contact_form['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                        </tr>
                        <?php } ?>
                        <?php } else { ?>
                        <tr>
                          <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </form>
                <div class="row">
                  <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                  <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php echo $footer; ?>