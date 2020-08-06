<?php echo $header; ?><?php echo $column_left; ?>
	<div id="content">
		<div class="page-header">
			<div class="container-fluid">
				<div class="pull-right">
					<button type="submit" form="form-coupon" data-toggle="tooltip" title="<?php echo $button_save; ?>"
							class="btn btn-primary"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>"
					   class="btn btn-default"><i class="fa fa-reply"></i></a></div>
				<h1><?php echo $heading_title; ?></h1>
				<ul class="breadcrumb">
					<?php foreach ( $breadcrumbs as $breadcrumb ) { ?>
						<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<div class="container-fluid">
			<?php if ( $error_warning ) { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
			<?php } ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
				</div>
				<div class="panel-body">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data"
						  id="form-contact_form" class="form-horizontal">
						<div class="tab-content">
							<div class="tab-pane active" id="tab-general">
								<div class="form-group required">
									<label class="col-sm-2 control-label"
										   for="input-contact_form_email"><?php echo $entry_contact_form_email; ?></label>
									<div class="col-sm-10">
										<input type="text" name="contact_form_email"
											   value="<?php echo $contact_form_email; ?>"
											   placeholder="<?php echo $entry_contact_form_email; ?>"
											   id="input-contact_form_email" class="form-control"/>
										<?php if ( $error_contact_form_email ) { ?>
											<div class="text-danger"><?php echo $error_contact_form_email; ?></div>
										<?php } ?>
									</div>
									<input type="hidden" name="contact_form_date"
										   value="<?php echo $contact_form_date; ?>"/>
								</div>
								<div class="form-group required">
									<label class="col-sm-2 control-label"
										   for="input-contact_form_name"><?php echo $entry_contact_form_name; ?></label>
									<div class="col-sm-10">
										<input type="text" name="contact_form_name"
											   value="<?php echo $contact_form_name; ?>"
											   placeholder="<?php echo $entry_contact_form_name; ?>"
											   id="input-contact_form_name" class="form-control"/>
									</div>
								</div>
								<div class="form-group required">
									<label class="col-sm-2 control-label"
										   for="input-contact_form_phone"><?php echo $entry_contact_form_phone; ?></label>
									<div class="col-sm-10">
										<input type="text" name="contact_form_phone"
											   value="<?php echo $contact_form_phone; ?>"
											   placeholder="<?php echo $entry_contact_form_phone; ?>"
											   id="input-contact_form_phone" class="form-control"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="contact_form_message"><?php echo $entry_contact_form_message; ?></label>
									<div class="col-sm-10">
										<textarea name="contact_form_message" rows="3" placeholder="<?php echo $entry_contact_form_message; ?>" id="contact_form_message" class="form-control"><?php echo isset($contact_form_message) ? $contact_form_message : ''; ?></textarea>
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