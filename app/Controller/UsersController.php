<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
    public $uses = array();
    
    public function index() {

        
	}
    
    public function home() {

        
	}
     public function logout() {
        
        $this->autoRender = false;
        $this->Auth->logout();
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
        
	}
    
    public function register() {
        if(!empty($this->Auth->User('id'))){
            return $this->redirect(['controller'=>'users','action'=>'home']);
        }
        
        //$this->set();
        if ($this->request->is('post') && !empty($this->request->data)) {
             
            $exUser=$this->User->find('first',array('conditions'=>array('User.username'=>$this->request->data['User']['username'])));
            if(!empty($exUser)){
                 $this->Session->setFlash('Email is taken!','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'users','action' => 'register'));
            }
            if($this->request->data['User']['password'] != $this->request->data['cnfrm_password']){
                 $this->Session->setFlash('Passwords didnt match!','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'users','action' => 'register'));
            }
            if(!empty($_POST['g-recaptcha-response'])){
                $captcha = $this->recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }else{$captcha=true;}
            
            if($captcha){
            
                $this->User->create();
                $this->request->data['User']['usertype_id']=2;
                $this->request->data['User']['email_confirmed']=0;
                require_once(APP . 'Vendor' . DS. 'genpwd'. DS. 'genpwd.php');
                $this->request->data['User']['ref_id'] = genpwd();
            
                if ($this->User->save($this->request->data['User'])) {
                    $email=$this->request->data['User']['username'];
                    $ref_id=$this->request->data['User']['ref_id'];
                    $basePath = SITEPATH;
                    $message = <<<HTML
<p>Hi {$email}.</p>
<p>Click <a href='{$basePath}users/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}users/confirm_email/{$ref_id}</p>
HTML;

                    $subject='Email verification';
                    $this->sendMail($email,$subject,$message);
                    $this->Session->setFlash('Registration was successful. You need to confirm your e-mail to proceed. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
                    return $this->redirect(array('controller'=>'users','action' => 'register'));
                }
                    $this->Session->setFlash('The user could not be saved. Please, try again. If the problem persists, please contact an FRG team member.','myflash',['params'=>['class' => 'flasherror message']]);
        
            } else{
                $this->Session->setFlash('We could not verify that you are human.','myflash',['params'=>['class' => 'flasherror message']]);
                
            } 
        }
        
	}
    
    function confirm_email($ref_id=NULL) {
        $this->autoRender = false;
          if(isset($ref_id)){
              $userDetails=$this->User->find('first',array('conditions'=>array('User.ref_id'=>$ref_id)));
              if(!empty($userDetails)){
                  if($userDetails['User']['email_confirmed']==1){
                      $this->Session->setFlash('Your e-mail address has been confirmed, proceed to login.','myflash',['params'=>['class' => 'flasherror message']]);
                      
                    return $this->redirect(array('controller'=>'users','action' => 'login'));
                  }
                  $this->User->updateAll(
                        array('User.email_confirmed' => 1),
                        array('User.id' => $userDetails['User']['id'])
                    );
                  $this->Session->setFlash("Your e-mail address has been confirmed, proceed to login.",'myflash',['params'=>['class' => 'flashsuccess message']]);
                  
                    return $this->redirect(array('controller'=>'users','action' => 'login'));
              }else{
                  $this->Session->setFlash('Invalid confirmation link. It may have been expired. Please try again.','myflash',['params'=>['class' => 'flasherror message']]);
                  
                return $this->redirect(array('controller'=>'users','action' => 'login'));
              }
                
          }else{
              $this->Session->setFlash('Invalid confirmation link. It may have been expired. Please try again.','myflash',['params'=>['class' => 'flasherror message']]);
                return $this->redirect(array('controller'=>'users','action' => 'login'));
          }
        
    }
    
    public function login() {
        if(!empty($this->Auth->User('id'))){
            return $this->redirect(['controller'=>'users','action'=>'home']);
        }
        if ($this->request->is('post') && !empty($this->request->data)) {
            if(!empty($_POST['g-recaptcha-response'])){
                $captcha = $this->recaptcha($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            }else{$captcha=true;}
            if($captcha){
                if ($this->Auth->login()){
                    if($this->Auth->User('email_confirmed')==0){
                        $email = $this->Auth->User('username');
                        $this->Auth->logout();
                        $this->Session->setFlash('You have not confirmed your e-mail address. Check your e-mail for further instructions.','myflash',['params'=>['class' => 'flasherror message','resend'=>1,'email'=>$email]]);
                        return $this->redirect(['controller'=>'users','action'=>'login']);
                    }
                    return $this->redirect(['controller'=>'users','action'=>'home']);
                }else{
                     $this->Session->setFlash('Invalid username or password, try again.','myflash',['params'=>['class' => 'flasherror message']]);
                    return $this->redirect(['controller'=>'users','action'=>'login']);
            
                }
            }
                        
        }
	}
    
    public function resend_email_verification($email=NULL){
        $this->autoRender = false;
        if(!empty($email)){
            
        $user = $this->User->find('first',array('conditions'=>array('User.username'=>$email)));
        if(!empty($user)){
        $email= $user['User']['username'];
        $ref_id= $user['User']['ref_id'];
        $basePath = SITEPATH;
        $message = <<<HTML
<p>Hi {$email}.</p>
<p>Click <a href='{$basePath}users/confirm_email/{$ref_id}'>here</a> to verify your E-mail or copy and paste the URL below into your browser to confirm your E-mail</p>
<p>{$basePath}users/confirm_email/{$ref_id}</p>
HTML;
        $subject='Email verification';
        $this->sendMail($email,$subject,$message);
        $this->Session->setFlash('E-mail Resent. Please check your e-mail for further instructions. Be sure to check spam/junk folder if our e-mail is not  in inbox!','myflash',['params'=>['class' => 'flashsuccess message']]);
        return $this->redirect(array('controller'=>'users','action' => 'login'));
        }else{
            $this->Session->setFlash('E-mail does not exist in our database!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'users','action' => 'login'));
        }
        }else{
            $this->Session->setFlash('Invalid URL!','myflash',['params'=>['class' => 'flasherror message']]);
        return $this->redirect(array('controller'=>'users','action' => 'login'));
        }
    }
    
    protected function recaptcha($response = NULL, $remoteadr=NULL){ 
        $this->autoRender = false;
        if(isset($response)){
            $captcha = $response;

            $postdata = http_build_query(
                array(
                    'secret'   => RC_SECRET,
                    'response' => $captcha,
                    'remoteip' => $remoteadr
                )
            );

            $options = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context = stream_context_create($options);
            $result  = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context));

            return $result->success;
        }else{
            return false;
        }
    }
    
    protected function sendMail($recipient=NULL,$subject=NULL,$message=NULL,$name=''){ 
        // print_r(openssl_get_cert_locations());
        require APP . 'Vendor' . DS. 'autoload.php';
        
        $toEmailAddress = $recipient;
        $content = $message;

        $transporter = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
        $transporter
            ->setUsername(G_UN)
            ->setPassword(G_PWD);

        $mailer = new Swift_Mailer($transporter);

        $message = new Swift_Message($subject);
        $message
            ->setFrom([G_UN => 'BitcoinThief Support'])
            ->setTo($toEmailAddress)
            ->setBody($content, 'text/html');

        $mailer->send($message);
         
    }
    
}