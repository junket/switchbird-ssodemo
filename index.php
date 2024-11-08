<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Switchbird Single Sign-On Example</title>
  
  <!-- Latest compiled and minified Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

  <!-- Local CSS -->
  <style>
  .field {
    margin: 10px;
  }
  .footer {
    padding-top: 20px;
    text-align: center;
  }
  .callout {
    padding: 20px 15px;
    background-color: #f6f6f6;
  }
  </style>

    
<?php
// Include config and libs
include (dirname(__FILE__).'/lib.php');
include (dirname(__FILE__).'/config.php');

date_default_timezone_set('UTC');

// Check for POST data:
$response = null;
if (isset($_POST["email_address"])) {
  if (filter_var($_POST["email_address"], FILTER_VALIDATE_EMAIL)) {  
    $data = array(
      'email' => $_POST["email_address"],
      'date' => date("Y-m-d H:i:s")
    );
    $token = JWT::encode($data, AUTH_SECRET, 'HS256');
    $response = "Login URL created.";
  } else {
    $response =  "Email is invalid.";
  }
};

?>
  
</head>
<body>

<div class="container">
  <div class="row">
  
  <div class="text-center my-5">
  <h1>Switchbird Single Sign-On Example</h1>

<?php // Show nicer feedback as needed ;)
if ($response) {
?><div class="alert alert-info"><p>
<?php print_r($response) ?>
</p></div>
<?php } ?>

  </div><!-- End .text-center -->
  </div><!-- End .row -->

  <div class="row">
  <div class="col-md-6 offset-md-3">
  <div class="callout">
  
  <h2>Create User Login URL</h2>

<?php
if ($response) {
?><pre>URL:
<?php echo AUTH_BASE_URL . '/' . $token ?>
</pre>
<p><a href="<?php echo AUTH_BASE_URL . '/' . $token ?>" target="_blank">Try it</a></p>
<?php } ?>

<form method="post" enctype="multipart/form-data" action="">
  
  <div class="field">
  <label for="email_address">User Email</label>
  <input name="email_address" type="text" value="" class="form-control" tabindex="1">
  </div>

  <div class="footer">
  <input type="submit" value="Submit" class="btn btn-primary">
  </div>
  
</form>
		
		</div><!-- End .callout -->
  </div><!-- End .col-md-6 -->
  </div><!-- End .row -->

</div><!-- End .container -->

</body>
</html>
