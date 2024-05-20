<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('assets');?>/img/blogspot.ico" type="image/x-icon" />
    <title>Contoh Google Recaptcha dengan Bootstrap (Versi 2)</title>
    <link rel="stylesheet" href="<?= base_url('assets');?>/css/bootstrap.min.css">
    <script type="text/javascript">
			var onloadCallback = function() {
				grecaptcha.render('html_element_google_recaptcha',{
					'sitekey' : '<?=$recaptcha_site_key;?>'
				});
			};
		</script>
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-body">
                        <?= form_open(base_url('versidua'), array('id'=>'form-login')); ?>
                          <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                                <?=form_error('username','<small class="text-danger pl-3">','</small>');?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <?=form_error('password','<small class="text-danger pl-3">','</small>');?>
                            </div>
							<div id="html_element_google_recaptcha" class="mb-5"></div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        <?= form_close();?>
                    </div>
                </div>
                <div class="alert alert-primary mt-4" role="alert">
                    Silahkan gunakan Username "admin" dan Password "admin".
                </div>
            </div>
        </div>
        <div class="text-right">
            <p><a href="https://www.pudin.my.id" target="_blank"> pudin.my.id </a></p>
        </div>
    </div>
    <script src="<?= base_url('assets');?>/js/jquery-3.7.1.min.js" ></script>
    <script src="<?= base_url('assets');?>/js/bootstrap.min.js" ></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
  </body>
</html>