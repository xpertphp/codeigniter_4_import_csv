<!DOCTYPE html>
<html>
<head>
  <title>Codeigniter 4 Import Excel/CSV File into Database Example - XpertPhp</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
</head>
<body>
 <div class="container">
    <div class="row">
      <div class="col-md-9">
	<?= \Config\Services::validation()->listErrors(); ?>
        <form method="post" name="frmAddStudent" id="frmAddStudent" action="<?php echo site_url('student/importFile');?>" enctype="multipart/form-data">
          <div class="form-group">
            <label for="file">Upload CSV/Excel file</label>
            <input type="file" name="file" class="form-control" id="file" />
          </div>
          <div class="form-group">
		   <input type="submit" value="Upload" name="btnadd" id="btnadd" class="btn btn-success" />
          </div>
        </form>
      </div>
    </div>
</div>
</body>
</html>


