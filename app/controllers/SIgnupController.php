<?php 
use Phalcon\Mvc\Controller;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Confirmation;

class SignupController extends Controller
{
    public function indexAction(){
        $this->view->users = Users::find();
    }
    public function registerAction()
    {
        if($this->request->getPost()['password'] != $this->request->getPost()['confirm_password']){   
        // Using direct flash
        $this->flashSession->error('Confirmation error: Password should match!');
        $this->response->redirect('/signup');
        $this->view->disable();
        return; 
        }  
        else{
            // 
            $user = new Users();
            $success = $user->save(
                $this->request->getPost(),
                ['firstname', 'lastname','email','gender','password']
            );
    
            // passing the result to the view
            $this->view->success = $success;
    
            if ($success) {
                $this->flashSession->success('Data saved successfully');
                $this->response->redirect('/signup');
            } else {
                //$errors = implode('<br>', $user->getMessages());
                $errors = $user->getMessages();
                foreach($errors as $error):
                    $this->flashSession->error($error);
                endforeach;
                $this->response->redirect('/signup');
            }
    
           
           // passing a message to the view
        $this->view->data = ['message'=>$message,'request'=>$this->request->getPost()];
        // $this->view->data = $this->view;



            // 

        }
        

    }
}
