<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>



            <div class="">
                <h2 class="title">Register New Account</h2>
<?php echo $this->Form->create('User', array('url'=>['controller'=>'users','action'=>'register'],'class' => '','id' => '')); ?>

  <?php echo $this->Session->flash(); ?>
                    <div class="" >
                        <input id="email" name="data[User][username]" class="" required  placeholder="Email Address" autofocus type="email">

                    </div>
                    <div class="" >
                        <input class="" name="data[User][password]" required  placeholder="Password" type="password">
                    </div>
                    <div class="" >
                        <input class="" name="data[cnfrm_password]" required  placeholder="Confirm Password" type="password">
                    </div>
                    <br>
                    <!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
                    <br>
                    <div class="">
                        <input class="" value="Register" type="submit">
                    </div>
 <?php echo $this->form->end(); ?>
            </div>
            <div class="">
                <p>
                     <a href="<?= SITEPATH.'telegrams/resetpassword'?>">Click Here </a>
                    to reset password.
                </p>
            </div>
            <div class="">
                <p>
                    Already registered? <a href="<?= SITEPATH.'login'; ?>">Click Here </a>
                     to Login.
                </p>
            </div>
       


