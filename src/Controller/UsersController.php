<?
    namespace App\Controller;

    use App\Controller\AppController;
    use Cake\Error\NotFoundException;
    use Cake\Event\Event;
    use Cake\Utility\Debugger;
    use Cake\Utility\Inflector;
    use Cake\Network\Email\Email;
    use Cake\Utility\String;
    class UsersController extends AppController {
        public function beforeFilter(Event $event) {
            parent::beforeFilter($event);
            $this->Auth->allow(['register', 'forgot', 'reset_password', 'logout']); //Do not add "login" the the allow array, it'll fuck shit up.
        }


        /* Login and Logout */
        public function login() {
            $this->layout = 'basic';
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);

                    return $this->redirect(['controller' => 'dashboard', 'action' => 'index']);
                }
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }

        public function logout() {
                    $user = $this->Users->get($this->Auth->user('id'));
                    $user['status'] = "offline";
                    if ($this->User->save($user)) {
                    $this->Flash->success(__('Come back soon!'));
                    }
            return $this->redirect($this->Auth->logout());
        }
        
        /* Index, View , Register */
        public function index() {
            $this->User->recursive = 0;
            $this->set('users', $this->paginate());
        }

        public function profile($id) {
            $this->layout = "profile";
            if (!$id) {
                throw new NotFoundException(__('Invalid user'));
            }

            $user = $this->Users->get($id);
            $this->set(compact('user'));
            $timezoneTable = array(
            "Pacific/Kwajalein" => "(GMT -12:00) Eniwetok, Kwajalein",
            "Pacific/Samoa" => "(GMT -11:00) Midway Island, Samoa",
            "Pacific/Honolulu" => "(GMT -10:00) Hawaii",
            "America/Anchorage" => "(GMT -9:00) Alaska",
            "America/Los_Angeles" => "(GMT -8:00) Pacific Time (US & Canada)",
            "America/Denver" => "(GMT -7:00) Mountain Time (US \& Canada)",
            "America/Chicago" => "(GMT -6:00) Central Time (US \& Canada), Chicago",
            "America/New_York" => "(GMT -5:00) Eastern Time (US \& Canada), New York",
            "Atlantic/Bermuda" => "(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",
            /* "Canada/Newfoundland" => "(GMT -3:30) Newfoundland", */
            "Brazil/East" => "(GMT -3:00) Brazil, Buenos Aires, Georgetown",
            "Atlantic/Azores" => "(GMT -2:00) Mid-Atlantic",
            "Atlantic/Cape_Verde" => "(GMT -1:00 hour) Azores, Cape Verde Islands",
            "Europe/London" => "(GMT) Western Europe Time, London, Lisbon, Casablanca",
            "Europe/Brussels" => "(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",
            "Europe/Helsinki" => "(GMT +2:00) Kaliningrad, South Africa",
            "Asia/Baghdad" => "(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",
            /* "Asia/Tehran" => "(GMT +3:30) Tehran", */
            "Asia/Baku" => "(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",
            /*"Asia/Kabul" => "(GMT +4:30) Kabul", */
            "Asia/Karachi" => "(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",
            /* "Asia/Calcutta" => "(GMT +5:30) Bombay, Calcutta, Madras, New Delhi", */
            "Asia/Dhaka" => "(GMT +6:00) Almaty, Dhaka, Colombo",
            "Asia/Bangkok" => "(GMT +7:00) Bangkok, Hanoi, Jakarta",
            "Asia/Hong_Kong" => "(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",
            "Asia/Tokyo" => "(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
            /* "Australia/Adelaide" => "(GMT +9:30) Adelaide, Darwin", */
            "Pacific/Guam" => "(GMT +10:00) Eastern Australia, Guam, Vladivostok",
            "Asia/Magadan" => "(GMT +11:00) Magadan, Solomon Islands, New Caledonia",
            "Pacific/Fiji" => "(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka"
            );
            $this->set('timezoneTable', $timezoneTable);
        }

        public function edit_profile($id){
            //Check if they are either and admin or editting their own profile
            if($this->Auth->user('is_admin') || ($this->Auth->user('id') == $id))
            {
                //if no id is provided, throw an exception
                if (!$id) {
                        throw new NotFoundException(__('Invalid user'));
                }
                //if this is a post/put request
                if ($this->request->is(['post', 'put'])) {
                    if($this->request->data['avatar']['name'])
                    {
                        $this->request->data['avatar'] = parent::upload($this->request->data['avatar']['tmp_name'], $this->request->data['avatar']['name'], 'avatars');
                        
                    }
                    else
                    {
                        $this->request->data['avatar'] = null;
                    }
                    if($this->request->data['background']['name'])
                    {
                        $this->request->data['background'] = parent::upload($this->request->data['background']['tmp_name'], $this->request->data['background']['name'], 'backgrounds');
                        
                    }
                    else
                    {
                        $this->request->data['background'] = null;
                    }
                    debug($this->request->data);
                    /*
                    $managers = $this->Users->find('all')->select(['id', 'display_name', 'is_manager'])->where(['is_manager' => true]);
                    $this->set(compact('managers'));
                        */
                    $user = $this->Users->get($id);
                    if(empty($this->request->data['avatar'])){
                        unset($this->request->data['avatar']);
                    }
                    if(empty($this->request->data['background'])){
                        unset($this->request->data['background']);
                    }
                    $user = $this->Users->patchEntity($user, $this->request->data);
                    if($this->Users->save($user)){
                        $this->Flash->success(__('Profile Updated!'));
                        return $this->redirect($this->referer());
                    }else{
                        $this->Flash->error(__('Profile Update Failed!'));
                        return $this->redirect($this->referer());
                    }
                }
            }
        }

        public function add()
        {
            $this->autoRender = false;
            if($this->Auth->user('is_admin'))
            {
             if ($this->request->is('post')) {
                 $user = $this->Users->newEntity($this->request->data);
                 $user->registration_code = String::uuid();
                 $user->activated = false;
                 if($user->manager_id == 'none'){
                    $user->manager_id = null;
                 }
                if($this->request->data['registration_sent']){
                $email = new Email('default');
                $email->from(['portal@risingtideteam.com' => 'Rising Tide'])
                ->to($user['email'])
                ->subject('Account Activation for '.$user['display_name'].' at Rising Tide')
                ->emailFormat('html')
                ->send('Dear '.$user['display_name'].', a registration code for Rising Tide has been sent to you.<br />
                    <br/>Please click <a href="http://portal.risingtideteam.com/users/register/'.$user['registration_code'].'">your registration link</a> to continue with the coaching process.<br /><br />
                    If the above does not work on your device you can copy this URL to your address bar:<br />
                    http://portal.risingtideteam.com/users/register/'.$user['registration_code']);
                    }

                    if($this->Users->save($user)) {
                    $this->Flash->success(__('User Added!'));
                    return $this->redirect(['action' => 'admin_index']);
                    }
                    $this->Flash->error(__('Unable to add user.'));
                }
            }
        }
        public function edit($id){
            if($this->Auth->user('is_admin') || ($this->Auth->user('id') == $id))
            {
                $this->layout = 'profile';

                    if (!$id) {
                        throw new NotFoundException(__('Invalid user'));
                    }

                    $user = $this->Users->get($id);
                    if ($this->request->is(['post', 'put'])) {
                        if($this->request->data['manager_id'] == $id){
                            $this->Flash->error(__("You cannot select yourself as your own manager!"));
                            return $this->redirect($this->referer());
                        }
                        if($this->request->data['manager_id'] == 'none'){
                            $this->request->data['manager_id'] = 'NULL';
                        }

                        if($this->request->data['registration_sent']){
                        $email = new Email('default');
                        $email->from(['portal@risingtideteam.com' => 'Rising Tide'])
                        ->to($user['email'])
                        ->subject('Account Activation for '.$user['display_name'].' at Rising Tide')
                        ->emailFormat('html')
                        ->send('Dear '.$user['display_name'].', a registration code for Rising Tide has been sent to you.<br />
                            <br/>Please click <a href="http://portal.risingtideteam.com/users/register/'.$user['registration_code'].'">your registration link</a> to continue with the coaching process.<br /><br />
                            If the above does not work on your device you can copy this URL to your address bar:<br />
                            http://portal.risingtideteam.com/users/register/'.$user['registration_code']);
                            $this->Flash->success(__('User Registration Link Sent'));
                            if ($this->Users->save($user)) {
                            return $this->redirect(['action' => 'admin_index']);
                            }
                        $this->Flash->error(__('Unable to send registration link.'));
                            }
                        $this->Users->patchEntity($user, $this->request->data);
                        if ($this->Users->save($user)) {
                            $this->Flash->success(__('User successfully edited.'));
                            return $this->redirect(['action' => 'admin_index']);
                        }
                        $this->Flash->error(__('Unable to edit user'));
                    }
                    /*
                    $managers = $this->Users->find('all')->select(['id', 'display_name', 'is_manager'])->where(['is_manager' => true]);
                    $this->set(compact('managers'));
                    */
                    $user = $this->Users->get($id);
                    $managers = $this->Users->find('all')->where(['is_manager' => 1])->select(['id','display_name']);
                    $this->set(compact('user'));
                    $this->set(compact('managers'));
                    
            }
        }

        public function delete($id) {
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('User deleted.'));
            return $this->redirect(['action' => 'admin_index']);
            }
        }

        public function admin_index()
        {
                
                $users = $this->Users->find('all');
                $this->set('users', $users);
                /*
                $managers = $this->Users->find('all')->select(['id', 'display_name', 'is_manager'])->where(['is_manager' => true]);
                $this->set(compact('managers'));
                */
                $managers = $this->Users->find('all')->where(['is_manager' => 1])->select(['id','display_name']);
                $this->set(compact('managers'));

        }
        public function register($invite_code) {
            $this->layout = 'basic';
            $user = $this->Users->find('all', ['conditions'=> ['registration_code' => $invite_code]])->first();
            $this->set('user', $user);
            if(!empty($user)){


                $timezoneTable = array(
                "Pacific/Kwajalein" => "(GMT -12:00) Eniwetok, Kwajalein",
                "Pacific/Samoa" => "(GMT -11:00) Midway Island, Samoa",
                "Pacific/Honolulu" => "(GMT -10:00) Hawaii",
                "America/Anchorage" => "(GMT -9:00) Alaska",
                "America/Los_Angeles" => "(GMT -8:00) Pacific Time (US &amp; Canada)",
                "America/Denver" => "(GMT -7:00) Mountain Time (US &amp; Canada)",
                "America/Chicago" => "(GMT -6:00) Central Time (US &amp; Canada), Mexico City",
                "America/New_York" => "(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima",
                "Atlantic/Bermuda" => "(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz",
                /* "Canada/Newfoundland" => "(GMT -3:30) Newfoundland", */
                "Brazil/East" => "(GMT -3:00) Brazil, Buenos Aires, Georgetown",
                "Atlantic/Azores" => "(GMT -2:00) Mid-Atlantic",
                "Atlantic/Cape_Verde" => "(GMT -1:00 hour) Azores, Cape Verde Islands",
                "Europe/London" => "(GMT) Western Europe Time, London, Lisbon, Casablanca",
                "Europe/Brussels" => "(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris",
                "Europe/Helsinki" => "(GMT +2:00) Kaliningrad, South Africa",
                "Asia/Baghdad" => "(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg",
                /* "Asia/Tehran" => "(GMT +3:30) Tehran", */
                "Asia/Baku" => "(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi",
                /*"Asia/Kabul" => "(GMT +4:30) Kabul", */
                "Asia/Karachi" => "(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent",
                /* "Asia/Calcutta" => "(GMT +5:30) Bombay, Calcutta, Madras, New Delhi", */
                "Asia/Dhaka" => "(GMT +6:00) Almaty, Dhaka, Colombo",
                "Asia/Bangkok" => "(GMT +7:00) Bangkok, Hanoi, Jakarta",
                "Asia/Hong_Kong" => "(GMT +8:00) Beijing, Perth, Singapore, Hong Kong",
                "Asia/Tokyo" => "(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk",
                /* "Australia/Adelaide" => "(GMT +9:30) Adelaide, Darwin", */
                "Pacific/Guam" => "(GMT +10:00) Eastern Australia, Guam, Vladivostok",
                "Asia/Magadan" => "(GMT +11:00) Magadan, Solomon Islands, New Caledonia",
                "Pacific/Fiji" => "(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka"
                );
                if ($this->request->is(['post', 'put'])) {
                        $user->activated = true;
                        $user->registration_code = null;
                        $user->join_date = time();
                        $this->Users->patchEntity($user, $this->request->data);
                        if ($this->Users->save($user)) {
                             $email = new Email('default');
                        $email->from(['portal@risingtideteam.com' => 'Rising Tide'])
                        ->to($user['email'])
                        ->subject('Account Activated at Rising Tide')
                        ->emailFormat('html')
                        ->send('Dear '.$user['display_name'].', thank you for registering for the Rising Tide app, your username is:<br />
                            <br>
                            Username: '.$user['username'].'<br />
                            <br />Login to <a href="http://portal.risingtideteam.com/">Rising Tide Login</a> to continue the coaching process');
                            $this->Flash->success(__('Account Activated, please log in!'));
                            return $this->redirect(['action' => 'login']);
                        }
                        $this->Flash->error(__('User Registration Failed'));
                        return $this->redirect(['action' => 'admin_index']);
                    }

                $this->set('timezoneTable', $timezoneTable);
                //$this->set('user', $user);

            }
            else{
                $this->Flash->error(__('Invalid Registration Code!'));
                return $this->redirect(['action' => 'login']);
            }
        }

        public function forgot()
        {
            $this->layout = 'basic';
            if($this->request->is('post'))
            {
                $user = $this->Users->find('all', ['conditions'=> ['email' => $this->request->data['email']]])->first();
                if(!empty($user) && $user['activated']){
                        $user->reset_code = String::uuid();
                      $email = new Email('default');
                        $email->from(['portal@risingtideteam.com' => 'Rising Tide'])
                        ->to($user['email'])
                        ->subject('Password Reset at Rising Tide')
                        ->emailFormat('html')
                        ->send('Dear '.$user['display_name'].', a password reset request at Rising Tide has been sent to you.<br />
                    <br/>Please click <a href="http://portal.risingtideteam.com/users/reset_password/'.$user['reset_code'].'">your reset link</a> to reset your password!<br /><br />
                    If the above does not work on your device you can copy this URL to your address bar:<br />
                    http://portal.risingtideteam.com/users/reset_password/'.$user['reset_code']);
                    if($this->Users->save($user))
                    {
                        $this->Flash->success(__('Password reset email sent!'));
                        return $this->redirect(['action' => 'login']);
                    }


                }
                else
                {
                    $this->Flash->error(__('Email not found!'));
                    return $this->redirect(['action' => 'forgot']);
                }
            }
        }

        public function reset_password($reset_code)
        {
            if(empty($reset_code))
            {
                $this->Flash->error(__('No Reset Code Given!'));
                return $this->redirect(['action' => 'forgot']);
            }
            $this->layout = 'basic';
            $user = $this->Users->find('all', ['conditions'=> ['reset_code' => $reset_code]])->first();
                if(!empty($user) && $user['activated']){

                    if($this->request->is('post'))
                    {
                
                    $user->reset_code = null;
                    $user->password = $this->request->data['password'];
                        if($this->Users->save($user)){
                        $email = new Email('default');
                        $email->from(['portal@risingtideteam.com' => 'Rising Tide'])
                        ->to($user['email'])
                        ->subject('Password Reset!')
                        ->emailFormat('html')
                        ->send('Dear '.$user['display_name'].', your recent password reset request was successful, please login with '.$user['username'].' for your username and the password you just set to continue the coaching process.');
                        $this->Flash->success(__('Password reset, please login!'));
                        return $this->redirect(['action' => 'login']);
                    }

                }
            
                $this->set('reset_code', $reset_code);
            }
            else
            {
                $this->Flash->error(__('Reset Code not Found!'));
                return $this->redirect(['action' => 'forgot']);
            }
        }
    }
?>