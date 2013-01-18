<?php
//If the form is submitted
if(isset($_POST['submit'])) {

	//Check to make sure that the name field is not empty
	if(trim($_POST['contactname']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['contactname']);
	}
	
	
	



	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['message']) == '') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'leadherforward2013@gmail.com'; // Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nPhone Number: $phone \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: My Site <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}
}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>LeadHer Forward Contact Us</title>
	
<link rel="stylesheet/less" type="text/css" href="assets/less/bootstrap.less">
  <link href="http://twitter.github.com/bootstrap/assets/css/bootstrap.css" rel="stylesheet">
<link href="http://twitter.github.com/bootstrap/assets/css/bootstrap-responsive.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js" type="text/javascript"></script>
<script src="./assets/js/scripts.js" type="text/javascript"></script>
<script src="./assets/js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>
<div class="container">
	
		<h2>Contact LeadHerForward</h2>
	
		
	
	<div class="row">
		<div class="span16">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
				<fieldset>
					<legend>Send Us a Message</legend>
					
					<?php if(isset($hasError)) { //If errors are found ?>
						<p class="alert-message error">Please check if you've filled all the fields with valid information and try again. Thank you.</p>
					<?php } ?>

					<?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
						<div id="confirmsuccess" class="modal hide fade in">
						<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3>Message Successfully Sent!</h3>
						</div>
						<div class="modal-body">
						<p>Thank you for contacting us, <strong><?php echo $name;?></strong>! Your email was successfully sent and we&rsquo;ll be in touch soon.</p>
						</div>
						<div class="modal-footer">
						<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>
						</div>
						</div>
						<script type="text/javascript">$('#confirmsuccess').modal('show');</script>

					<?php } ?>
					
			
					<div class="clearfix">
						<label for="name">
							Your Name<span class="help-required">*</span>
						</label>
						<div class="input">
							<input type="text" name="contactname" id="contactname" value="" class="span6 required" role="input" aria-required="true" />
						</div>
					</div>
					
					

					<div class="clearfix">
						<label for="email">
							Your Email<span class="help-required">*</span>
						</label>
						<div class="input">
							<input type="text" name="email" id="email" value="" class="span6 required email" role="input" aria-required="true" />
						</div>
					</div>
					
					
					

					

					<div class="clearfix">
						<label for="message">Message<span class="help-required">*</span></label>
						<div class="input">
							<textarea rows="8" name="message" id="message" class="span10 required" role="textbox" aria-required="true"></textarea>
						</div>
					</div>
					<div class="actions">
						<input type="submit" value="Send Your Message" name="submit" id="submitButton" class="btn primary" title="Click here to submit your message!" />
						<input type="reset" value="Clear Form" class="btn" title="Remove all the data from the form." />
					</div>
				</fieldset>
			</form>
		</div><!-- form -->
	</div><!-- row -->
</div><!-- container -->
</body>
</html>
