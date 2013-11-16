<div class="page-header dashboard">
	<h4>Edit Groups <small>Edit the user groups</small></h4>
</div>

    <form method="POST" class="form-horizontal" role="form">
      <fieldset>
	    <div class="form-group">
		  <label for="group_name" class="col-lg-3 control-label">Group Name:</label>
		  <div class="col-lg-4">
	        <?php echo form_error('group_name'); ?>
	        <input type="text" name="group_name" class="form-control" id="page_title" placeholder="Group Name" value="<?php echo set_value('group_name', $group_name); ?>">
		  </div>
		</div>

	    <div class="form-group">
		  <label for="group_description" class="col-lg-3 control-label">Group Description:</label>
		  <div class="col-lg-9">
	        <?php echo form_error('group_description'); ?>
	        <input type="text" name="group_description" class="form-control" id="group_description" placeholder="Group Description" value="<?php echo set_value('group_description', $group_description); ?>">
		  </div>
		</div>

        <button type="submit" value="Submit" name="submit" class="btn btn-primary">Update</button>
      </fieldset>
    </form>