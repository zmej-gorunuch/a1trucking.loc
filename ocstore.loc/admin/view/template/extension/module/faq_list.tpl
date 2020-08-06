<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
 <!-- Header-->
 <div class="page-header">
  <div class="container-fluid">
   <div class="pull-right">
    <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
    <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-article').submit() : false;"><i class="fa fa-trash-o"></i></button>
   </div>
   <h1><?php echo $heading_title; ?></h1>
   <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
   </ul>
  </div>
 </div>
 <!-- /Header-->
 <!-- Content -->
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
    <!-- Filter -->
    <div class="well">
      <div class="row">
       <div class="col-sm-6">
        <div class="form-group">
         <label class="control-label" for="input-status"><?php echo $entry_status; ?></label>
         <select name="filter_status" id="input-status" class="form-control">
          <option value="*"></option>
          <?php if ($filter_status) { ?>
          <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
          <?php } else { ?>
          <option value="1"><?php echo $text_enabled; ?></option>
          <?php } ?>
          <?php if (!$filter_status && !is_null($filter_status)) { ?>
          <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
          <?php } else { ?>
          <option value="0"><?php echo $text_disabled; ?></option>
          <?php } ?>
         </select>
        </div>
        <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
       </div>
      </div>
    </div>
    <!-- /Filter -->
    <!-- ListContent -->
    <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-article">
     <div class="table-responsive">
      <table class="table table-bordered table-hover">
       <thead>
        <tr>
         <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
         <td class="text-left"><?php echo $column_title; ?></td>
         <td class="text-left"><?php echo $column_cat_title; ?></td>
         <td class="text-left"><?php if ($sort == 'p.status') { ?>
          <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
          <?php } else { ?>
          <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
          <?php } ?></td>
         <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
       </thead>
       <tbody>
        <?php if ($questions) { ?>
        <?php foreach ($questions as $question) { ?>
        <tr>
         <td class="text-center"><?php if (in_array($question['id'], $selected)) { ?>
          <input type="checkbox" name="selected[]" value="<?php echo $question['id']; ?>" checked="checked" />
          <?php } else { ?>
          <input type="checkbox" name="selected[]" value="<?php echo $question['id']; ?>" />
          <?php } ?></td>
         <td class="text-left"><?php echo $question['title']; ?></td>
         <td class="text-left"><?php echo $question['category']; ?></td>
         <td class="text-left"><?php echo $question['status']; ?></td>
         <td class="text-right"><a href="<?php echo $question['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
         <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
       </tbody>
      </table>
     </div>
    </form>
    <!-- /ListContent -->
    <div class="row">
     <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
     <div class="col-sm-6 text-right"><?php echo $results; ?></div>
    </div>
   </div>
  </div>
 </div>
 <!-- /Content -->
</div>
<script type="text/javascript"><!--
 $('#button-filter').on('click', function() {
  var url = 'index.php?route=faq/questions&token=<?php echo $token; ?>';

  var filter_status = $('select[name=\'filter_status\']').val();

  if (filter_status != '*') {
   url += '&filter_status=' + encodeURIComponent(filter_status);
  }

  location = url;
 });
 //--></script>
<?php echo $footer; ?>