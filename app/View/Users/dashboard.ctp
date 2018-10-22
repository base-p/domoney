 <?php echo $this->Html->css('new.css');?>

<!-- header -->

<?php echo $this->element('nav');?>

<!-- sidebar -->
<?php echo $this->element('side-nav',['email'=>$email,'admin'=>$admin]);?>
<div class = "row">
    <div class="col s12 l9 m12 push-l3">
       <?php echo $this->Session->flash(); ?>
    </div>
</div>
<div class="row">
    <div class="col s12 l9 m12 push-l3">
       <div class="">
<script>
	var SITEPATH = '<?php echo SITEPATH; ?>';
 </script>
<div class="row obum-margin-top">
    <div class="col s12 m7 push-m2">
      <div class="card white ">
        <div class="card-content">
          <span class="card-title center-align pump-heading">Dashboard</span>
             
<?php echo $this->Form->create('Option', array('url'=>['controller'=>'telegrams','action'=>'dashboard'],'class' => '','id' => '')); ?>
        
    
         <div class="input-field col s12" >
            
            <select  name="data[account_id]" id="exchange" required>
              <option value="" disabled selected>Select Account...</option>
              <?php foreach($options as $option){ ?>
             <option value="<?php echo $option['Option']['id'];?>"><?php echo $option['Option']['alias'];?></option>
             <?php } ?>
             </select>
             <label>Select Exchange/Account for Pump</label>
        </div>  
        <div class="input-field col s12" >
            
            <select  name="data[sell_mode]" id="sell_mode" required>
              <option value="" disabled selected>Select Sell Mode...</option>
             <option value="0">Panic + AutoSell</option>
             <option value="1">Panic Only</option>
             </select>
             <label>Select Sell Mode</label>
        </div>  
        <div class="input-field col s12" >
            <label for='signal' >Signal Symbol(In CAPS E.g. DGB)</label>
            <input required id='signal' type='text' name="data[signal]"/>
        </div>
        <div class="input-field col s12">
            <label for='amount' class=''>BTC Amount to commit(Optional if setup in my account)</label>
            
            <input id='amount' type='text' class='' name="data[btc_amount]"/>
        </div>
           <div class="input-field col s12" >
            <i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Depth to enter the Orderbook. Higher value means higher entry price and faster order execution.  Default is 2">help</i>
            <select name="data[depth]" id="depth" required>
                <option value="" disabled >Select Depth...</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2" selected>2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
             </select>
             <label>Select Entry Depth</label>
        </div>   
            
        
<!--    
    <div id='recaptcha' class="g-recaptcha" data-sitekey="6Ld_1UEUAAAAAADb_csEomGPzZUh9dZmCyRAYtl8" data-callback="onSubmit" data-size="invisible" data-badge="bottomleft">
        </div>
-->
        <div class='center-align'>
            <button class="waves-effect waves-light btn teal" type='submit'>Enter Pump</button>
        </div>

            <?php echo $this->form->end(); ?>
          </div>
          
        </div>
    </div>
    </div>
<div class="row">    
    <a class="btn-floating btn-large red darken-1 pulse"><i class="material-icons">network_check</i></a><span class="pump-heading">Active</span>
<?php if(!empty($active_pumps)){ ?>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>BUY PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>SELL PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($active_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['price']; ?></td>
                        <td><?= $active_pump['Pump']['sell_price']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td><?php if($active_pump['Pump']['active'] == 1){echo "Buy Order Placed!";}else{echo "Buy Order Executed! Sell order placed!";} ?></td>
                        
                        <td>
                            <a href="<?= SITEPATH.'telegrams/panic/'.$active_pump['Pump']['id'] ; ?>" class="waves-effect waves-light btn  red darken-1">PANIC<i class="material-icons right">report_problem</i></a>
                            <a href="<?= SITEPATH.'telegrams/deleterecord/'.$active_pump['Pump']['id'] ; ?>" class="waves-effect waves-light btn  red darken-1">DELETE<i class="material-icons right">close</i></a>
                            </td>
                        
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            <?php }else{ ?> 
                <div class="row">
                <span class ="obum-special">No Activity Recorded Yet</span>
                </div>
            <?php } ?>
           </div>
            <div class="row">
            <a class="btn-floating btn-large teal"><i class="material-icons">loop</i></a>
            <span class="pump-heading">Completed</span>
            <?php if(!empty($history_pumps)){ ?>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>BUY PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>SELL PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($history_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['price']; ?></td>
                        <td><?= $active_pump['Pump']['sell_price']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td>Completed</td>
                        
                        <td>
                            <a href="<?= SITEPATH.'telegrams/deleterecord/'.$active_pump['Pump']['id'] ; ?>" class="waves-effect waves-light btn  red darken-1">DELETE<i class="material-icons right">close</i></a></td>
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            <?php }else{ ?>
                <div class="row">
                <span class ="obum-special">No Activity Recorded Yet</span>
                </div>
            <?php } ?>
           </div>
            <div class="row">
            <a class="btn-floating btn-large red"><i class="material-icons">report_problem</i></a>
             <span class="pump-heading">Panics</span>
             <?php if(!empty($panic_pumps)){ ?>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>BUY PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>SELL PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($panic_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['price']; ?></td>
                        <td><?= $active_pump['Pump']['sell_price']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td>You panicked!</td>
                        
                        <td><a href="<?= SITEPATH.'telegrams/deleterecord/'.$active_pump['Pump']['id'] ; ?>" class="waves-effect waves-light btn  red darken-1">DELETE<i class="material-icons right">close</i></a></td>
                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            <?php }else{ ?> 
                <div class="row">
                <span class ="obum-special">No Activity Recorded Yet</span>
                </div>
            <?php } ?>
           </div>
            <div class="row">
            <a class="btn-floating btn-large red darken-1"><i class="material-icons">close</i></a>
             <span class="pump-heading">Cancelled</span>
             <?php if(!empty($cancelled_pumps)){ ?>
    <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>EXCHANGE</th>
                        <th>TRADEPAIR</th>
                        <th>BUY PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>SELL PRICE<i class="material-icons tooltipped prefix " data-position="top" data-tooltip="Actual trade prices may vary, as Limit orders are used">help</i></th>
                        <th>DATETIME</th>
                        <th>STATUS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cancelled_pumps as $active_pump){ ?>
                    <tr>
                        <td><?= $active_pump['Pump']['id']; ?></td>
                        <td><?= $active_pump['Option']['Exchange']['exchange_name']; ?></td>
                        <td><?= $active_pump['Pump']['pair']; ?></td>
                        <td><?= $active_pump['Pump']['price']; ?></td>
                        <td><?= $active_pump['Pump']['sell_price']; ?></td>
                        <td><?= $active_pump['Pump']['created']; ?></td>
                        <td>Cancelled</td>
                        
                        <td><a href="<?= SITEPATH.'telegrams/deleterecord/'.$active_pump['Pump']['id'] ; ?>" class="waves-effect waves-light btn  red darken-1">DELETE<i class="material-icons right">close</i></a></td>

                    </tr>
                   <?php } ?> 
                </tbody>
                <!--<tfoot>
                <tr>
                    <td colspan='4'>
                        <?php echo $this->element('paging_links'); ?>
                        <p>Total number of transactions: <?= $total ?>.</p>
                    </td>
                </tr>
                </tfoot>-->
            </table>
            <?php }else{ ?> 
                <div class="row">
                <span class ="obum-special">No Activity Recorded Yet</span>
                </div>
            <?php } ?>
           </div>
    </div>
    </div>
</div>
<!-- js -->
<?php echo $this->Html->script('jquery-3.js');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
<?php echo $this->Html->script('myjs.js');?>

