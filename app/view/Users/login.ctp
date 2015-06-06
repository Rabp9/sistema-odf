<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from wbpreview.com/previews/WB0F56883/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Feb 2015 19:04:15 GMT -->
<head>
    <meta charset="utf-8" />
        <title>Sistema ODF</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <meta name="MobileOptimized" content="320">

        <!-- Le styles -->    
        <?php echo $this->Html->css("login/bootstrap.min"); ?>
        <?php echo $this->Html->css("login/bootstrap-responsive.min"); ?>
        <?php echo $this->Html->css("login/typica-login"); ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le favicon -->
        <?php echo $this->Html->meta("icon", "img/icono1.png"); ?>
	
	<script>
            valor = document.getElementById("text").value;
            if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
              return false;
            }
	</script>

  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand">
              <?php echo $this->Html->image("login/logo1.png") ?>
          </a>
        </div>
      </div>
    </div>

    <div class="container">

        <div id="login-wraper">
            <?php echo $this->Form->create("User", array("class" => "form login-form")); ?>
                <legend>Sistema <span class="blue">ODF</span></legend>     
                <div class="body">
                    <?php echo $this->Form->input("username"); ?>
                    <?php echo $this->Form->input("password"); ?>
                </div>
                
                <div class="footer">    
                    <?php echo $this->Form->button("INGRESAR", array("class" => "btn btn-success")); ?>
                </div>
            <?php echo $this->Form->end() ?>
        </div>

    </div>

    <footer class="white navbar-fixed-bottom">
      2015 &copy; Telefónica del Perú.
    </footer>


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

        <?php  
            echo $this->Html->script("login/jquery");
            echo $this->Html->script("login/bootstrap");
            echo $this->Html->script("login/backstretch.min");
            echo $this->Html->script("login/typica-login");
        ?>

  </body>

<!-- Mirrored from wbpreview.com/previews/WB0F56883/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 19 Feb 2015 19:04:20 GMT -->
</html>
