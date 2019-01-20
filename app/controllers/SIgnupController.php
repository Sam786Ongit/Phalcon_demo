<?php 
use Phalcon\Mvc\Controller;

class SignupController extends Controller
{
    public function indexAction(){
        $this->view->users = Users::find();
    }
    public function registerAction()
    {
        $user = new Users();
        $success = $user->save(
            $this->request->getPost(),
            ['firstname', 'lastname','email','gender','password']
        );

        // passing the result to the view
        $this->view->success = $success;

        if ($success) {
            $message = "Thanks for registering2!";
        } else {
            $message = "Sorry, the following problems were generated:<br>" . implode('<br>', $user->getMessages());
        }

       
       // passing a message to the view
       $this->view->data = ['message'=>$message,'request'=>$this->request->getPost()];
    }
}
