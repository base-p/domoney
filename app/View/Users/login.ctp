<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>

<?php echo $this->Session->flash(); ?>
            <div>
                <h2 class="title">Members Login</h2>
<?php echo $this->Form->create('User', array('url'=>['controller'=>'users','action'=>'login'],'class' => '','id' => '')); ?>

                    <div >
                        <input id="" name="data[User][username]" class="" required  placeholder="Email Address" autofocus type="email">
                    </div>
                    <div class="" >
                        <input class="" name="data[User][password]" required  placeholder="Password" type="password">
                    </div>
                    <br>
                    <!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
                    <br>
                    <div class="">
                        <input class="" value="Login" type="submit">
                    </div>
 <?php echo $this->form->end(); ?>
            </div>
            <div >
                <p>
                   <a href="<?= SITEPATH.'users/resetpassword'?>">Click Here </a>
                    to reset password.
                </p>
            </div>
            <div >
                <p>
                    <a href="<?= SITEPATH.'register'; ?>">Click Here </a>
                     to Register.
                </p>
            </div>
        





