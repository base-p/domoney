
<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>

             <?php echo $this->Session->flash(); ?>
    <!-- header -->

<?php echo $this->Html->css('base.css');?>
<header class="">
    <div class="inner">
            <nav class="actions">

                <ul class="links">
                            <li>
                                <div class="back">
                                    <div class="cta">
                                        <a class="back-button dark-white" href="<?= SITEPATH; ?>">
                                            <span>BitcoinThief Bot</span>
                                        </a>
                                    </div>
                                </div>
                            </li>

                </ul>
            </nav>

    </div>
</header>

    <!-- content -->
    <div class="wrapper">

<div class="login-container">
    <div class="inner">
        <div class="login" >
            <div class="box">
                <h2 class="title">Reset Password</h2>
<?php echo $this->Form->create('User', array('url'=>['controller'=>'telegrams','action'=>'resetpassword'],'class' => 'form','id' => 'loginForm')); ?>

  
                    <div class="form-group" >
                        <input id="email" name="data[email]" class="form-control" required  placeholder="Email Address" autofocus type="email">
<!--                        <span  role="alert" class="control-label">Error.</span>-->
                </div>
                    <br>
                    <!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
                    <br>
                    <div class="action">
                        <input class="gold" value="Reset Password" type="submit">
                    </div>
 <?php echo $this->form->end(); ?>
            </div>
            <div class="forgot-details">
                <p>
                    Want to Login instead? <a href="<?= SITEPATH.'login'?>">Click Here </a>
                    <br> to login.
                </p>
            </div>
            <div class="forgot-details">
                <p>
                    New to Bitcointhief Bot? please <a href="<?= SITEPATH.'register'; ?>">Click Here </a>
                    <br> to Register.
                </p>
            </div>
        </div>

    </div>
</div>



    </div>

    <!-- footer -->

<footer>
    <div class="inner">
        <div class="disclaimer">
            
            
        </div>
        <div class="copyright">
           <?= $this->Html->image('logo.png',['class'=>'','alt'=>'']); ?>
            <span>© All rights reserved, Copyright 2018 BitcoinThief Bot</span>
        </div>

            
    </div>
</footer>




    <!-- js -->
    <?php echo $this->Html->script('jquery-3.js');?>
    <?php echo $this->Html->script('bootstrap-3.js');?>



