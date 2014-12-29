<?
namespace App\Controller;
use tcpdf\TCPDF;
use App\Controller\AppController;
use Cake\Utility\String;
use Cake\Utility\Time;
use Cake\Network\Email\Email;
use Cake\Event\Event;

class FormsController extends AppController {
    public function beforeFilter(Event $event){
            parent::beforeFilter($event);
    }

    
    public function index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'forms');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->Forms->newEntity($this->request->data);
            if ($this->Forms->save($query))
            {
                $this->Flash->success(__('Form Added!'));

                return $this->redirect(['action' => 'index']);
            }
            else
            {
            $this->Flash->error(__('Form could not be added'));
            }
        }
        $this->loadModel('Users');
        $users = $this->Users->find('all', [
            'order' => 'Users.status DESC'
        ]);
        $this->set('users', $users);

        $this->loadModel('Sheets');
            $forms = $this->Forms->find('all')->select(['id', 'phase', 'color', 'name', 'file', 'description'])->contain(['Sheets']);
            $this->set('forms', $forms);
              
    }
    public function admin_index() {
        if ($this->request->is('post')) {
            if($this->request->data['file']['name'])
            {
                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'forms');
                
            }
            else
            {
                $this->request->data['file'] = null;
            }
            $query = $this->Forms->newEntity($this->request->data);
            if ($this->Forms->save($query))
            {
                $this->Flash->success(__('Form Added!'));
                return $this->redirect(['action' => 'admin_index']);
            }
            else
            {
            $this->Flash->error(__('Form could not be added'));
            }
        }
        $this->loadModel('Users');
        $users = $this->Users->find('all', [
            'order' => 'Users.status DESC'
        ]);
        $this->set('users', $users);

            $query = $this->Forms->find('all')->find('threaded', [
                'order' => 'Forms.lft ASC'
                ]);
            $this->set('forms', $query);
        $formlist = $this->Forms->find('treeList');
        $this->set('formlist', $formlist);
              
    }

    public function edit($id){
    		//if they are an admin CHANGE THIS TO USE AUTH
            if($this->Auth->user('is_admin'))
            {
            		//Throw an error if no id is provided
                    if (!$id) {
                        throw new NotFoundException(__('Invalid user'));
                    }

                    //Lookup the form
                    $form = $this->Forms->get($id);

                    if ($this->request->is(['post', 'put'])) {
                    //Check if a file has been uploaded.
                    debug($this->request->data);
                    if($this->request->data['file']['name'])
		            {
		                $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'forms');
		                
		            }
		            else
		            {
		                $this->request->data['file'] = null;
		            }
                        $this->Forms->patchEntity($form, $this->request->data);
                        if ($this->Forms->save($form)) {
                            $this->Flash->success(__('Form successfully edited.'));
                            return $this->redirect(['action' => 'admin_index']);
                        }
                        $this->Flash->error(__('Unable to edit form'));
                    }
                 $form = $this->Forms->get($id);
                 $this->set(compact('form'));

                 $this->loadModel('FormElements');
                 $formelements = $this->FormElements->find('all');
                 $this->set(compact('formelements'));

                 $this->loadModel('FormSections');
                 $formsections = $this->FormSections->find()->where(['form_id' => $id]);
                 $this->set(compact('formsections'));

                 $this->loadModel('FormItems');
                 $formitems = $this->FormItems->find('all');
                 $this->set(compact('formitems'));


            }
            else{
                $this->Flash->error(__('You are not an administrator!'));
                return $this->redirect($this->referer());
            }
        }
    public function delete_sheet($id) {
    $this->loadModel('Sheets');
    $sheet = $this->Sheets->get($id);
    if ($this->Sheets->delete($sheet)) {
        $this->Flash->success(__('Sheet deleted.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $sheet->name, '/wiki', 'deleted the entry');
        return $this->redirect(['action' => 'index']);
        }
    }
    public function add_section(){
        $this->loadModel('FormSections');
        $this->loadModel('Forms');
          $query = $this->FormSections->newEntity($this->request->data);
          $form = $this->Forms->get($query->form_id);
            if ($this->FormSections->save($query))
            {
                $this->Flash->success(__('Section Added!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '/wiki', 'added the section');
                return $this->redirect($this->referer());
            }
            else
            {
            $this->Flash->error(__('Section could not be added'));
            }
    }    
    public function add_item(){
        $this->loadModel('FormItems');
          $query = $this->FormItems->newEntity($this->request->data);
            if ($this->FormItems->save($query))
            {
                $this->Flash->success(__('Item Added!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '/wiki', 'added the section');
                return $this->redirect($this->referer());
            }
            else
            {
            $this->Flash->error(__('Item could not be added'));
            }
    }

    public function add_element(){
        $this->loadModel('FormElements');
          $query = $this->FormElements->newEntity($this->request->data);
            if ($this->FormElements->save($query))
            {

                $this->Flash->success(__('Form Element Added!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '/wiki', 'added the element');
                return $this->redirect($this->referer());
            }
            else
            {
            $this->Flash->error(__('Form Element could not be added'));
            }
    }

    public function edit_element($id){
        $this->loadModel('FormElements');
          $query = $this->FormElements->get($id);
          if($this->request->is('POST')){
            $this->FormElements->patchEntity($query, $this->request->data);
            if ($this->FormElements->save($query))
            {
                $this->Flash->success(__('Form Element Edited!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '#', 'editted the element');
                return $this->redirect($this->referer());
            }
            else
            {
            $this->Flash->error(__('Form Element could not be edited'));
            }
        }
        $this->set('formelement', $query);
    }
    
    public function delete($id) {
    $board = $this->Forms->get($id);
    if ($this->Forms->delete($board)) {
        $this->Flash->success(__('Form deleted.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $board->name, '#', 'deleted the form');
        return $this->redirect(['action' => 'admin_index']);
        }
    }

    public function formelement_delete($id) {
    $board = $this->Forms->get($id);
    if ($this->Forms->delete($board)) {
        $this->Flash->success(__('Form Element deleted.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '#', 'deleted the element');
        return $this->redirect(['action' => 'admin_index']);
        }
    }

    public function delete_section($id) {
    $this->loadModel('FormSections');
    $query = $this->FormSections->get($id);
    if ($this->FormSections->delete($query)) {
        $this->Flash->success(__('Section deleted.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '#', 'deleted the section');
        return $this->redirect($this->referer());
        }
    }

    public function delete_item($id) {
    $this->loadModel('FormItems');
    $query = $this->FormItems->get($id);
    if ($this->FormItems->delete($query)) {
        $this->Flash->success(__('Item deleted.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '#', 'deleted the item');
        return $this->redirect($this->referer());
        }
    }

    public function delete_Element($id) {
    $this->loadModel('FormElements');
    $query = $this->FormElements->get($id);
    if ($this->FormElements->delete($query)) {
        $this->Flash->success(__('Element deleted.'));
        return $this->redirect($this->referer());
        }
    }


    public function edit_sheet($id){
        $this->loadModel('FormSections');
        $this->loadModel('FormItems');
        $this->loadModel('FormElements');
        $this->loadModel('Sheets');
        $this->loadModel('SheetItems');
        $this->loadModel('Files');
        $this->loadModel('Users');
        $files = $this->Files->find('all')->where(['sheet_id' => $id]);
        $sheet = $this->Sheets->get($id, [
            'contain' => ['Users']
        ]);
        $form = $this->Forms->get($sheet['form_id']);
        $formsections =  $this->FormSections->find('all')->where(['form_id' => $sheet['form_id']]);
        $formitems =  $this->FormItems->find('all');
        $sheetitems = $this->SheetItems->find('all')->where(['sheet_id' => $sheet['id']]);
        $formelements =  $this->FormElements->find('all');
        $this->set('formsections', $formsections);
        $this->set('formitems', $formitems);
        $this->set('formelements', $formelements);
        $this->set('form', $form);
        $this->set('sheet', $sheet);
        $this->set('sheetitems', $sheetitems);
        $this->set('files', $files);
        //$this->set('authors', $authors);
        //$this->set('foruser', $foruser);


        $sheetelements = $this->FormElements->find('list')->where(['form_id' => $id])->select('name');
        $this->set('sheetelements', $sheetelements);

    }
    //MAKE A NEW USER FORM
    public function new_sheet($id){
        $this->loadModel('FormElements');
        $form = $this->Form->get($id);
        $formelements =  $this->FormElements->find()->where(['form_id' => $id])->select('name');

        //Add a sheet to the database
        $this->loadModel('Sheets');
        $query = $this->Sheets->newEntity();
        
        $query->form_id = $id;
        $query->year = date("Y");
        $query->name = $this->request->data['name'];
            if ($this->Sheets->save($query))
            {
                $this->Flash->success(__('Sheet Added!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '/forms/edit_sheet/'.$query->id, 'added the entity');
                return $this->redirect($this->referer());
            }
            else
            {
            $this->Flash->error(__('Sheet could not be added'));
            return $this->redirect($this->referer());
            }

    }

    public function add_sheetitem($sheetid, $item_id){
        if(!$item_id){
            $this->Flash->error(__('Invalid Item'));
            return $this->redirect($this->referer());
        }
         if(!empty($this->request->data['file']))
                    {
                        $this->request->data['file'] = parent::upload($this->request->data['file']['tmp_name'], $this->request->data['file']['name'], 'forms');
                        
                    }
                    else
                    {
                        $this->request->data['file'] = null;
                    }
        $this->loadModel('FormItems');
        $this->loadModel('FormElements');
        $this->loadModel('SheetItems');
        $this->loadModel('Sheets');
        $sheetname = $this->Sheets->get($sheetid)->extract(['name']);
        $formitem = $this->FormItems->get($item_id);
        $query = $this->SheetItems->newEntity();
        $query->user_id = $this->Auth->user('id');
        $query->sheet_id = $sheetid;
        $query->form_items_id = $item_id;
        $query->manager_id = $this->Auth->user('manager_id');
        $html = $this->FormElements->get($this->request->data['formelement_id'])->view_template;
        foreach($this->request->data as $key => $value){
            if(!empty($value)){
                $html = String::insert($html, [$key => $value]);
            }
        }
        $query->content = $html;

            if ($this->SheetItems->save($query))
            {
                $this->Flash->success(__('Sheet Item Added!'));
                $this->add_activity($this->Auth->user('id'), 'wiki', $sheetname['name'], '/forms/edit_sheet/'.$sheetid, 'added '.$formitem->name.' to');
                return $this->redirect($this->referer().'#'.$formitem['name']);
            }
            else
            {
            $this->Flash->error(__('Sheet Item could not be added'));
            return $this->redirect($this->referer());
            }
    }

    public function delete_sheetitem($id){
       $this->loadModel('SheetItems');
    $query = $this->SheetItems->get($id);
    if ($this->SheetItems->delete($query)) {
        $this->Flash->success(__('Item removed.'));
        $this->add_activity($this->Auth->user('id'), 'wiki', $query->name, '#', 'deleted the item');
        return $this->redirect($this->referer());
        }
    }


    public function upload_files($sheetid)
    {
        if($this->request->is('post')){
        $this->loadModel('Files');
        $numfiles = 0;
        foreach($this->request->data['files'] as $property => $value){
                       
            if(!empty($value['tmp_name']))
                {
                    $value['url'] = parent::upload($value['tmp_name'], $value['name'], 'sheets');            
                }
                else
                {
                    $this->Flash->error(__('Some files could not be added'));
                }
            
            $query = $this->Files->newEntity($value);
            $query->sheet_id = $sheetid;
            if ($this->Files->save($query))
                {
                    $numfiles++;
                    $this->Flash->success(__($numfiles.' Files Added!'));
                }
            else
                {
                    $this->Flash->error(__('Upload could not be added'));
                    //return $this->redirect($this->referer());
                    debug($value);
                    debug($property);
                }
            } 
            return $this->redirect($this->referer().'#Uploader');
        }
    }

    public function delete_file($id) {
    $this->loadModel('Files');
    $query = $this->Files->get($id);
    if ($this->Files->delete($query)) {
        $this->Flash->success(__('File deleted.'));
        return $this->redirect($this->referer().'#Uploader');
        }
    }

    public function dismiss_meeting($id) {
    $this->loadModel('Meetings');
    $query = $this->Meetings->get($id);
    if ($this->Meetings->delete($query)) {
        $this->Flash->success(__('Meeting dismissed.'));
        return $this->redirect($this->referer());
        }
    }
    public function reject_meeting($id) {
    $this->loadModel('Meetings');
    $this->loadModel('Sheets');
    $this->loadModel('Users');
    $query = $this->Meetings->get($id);
    $sheet = $this->Sheets->get($query->sheet_id);
    if(!$sheet->approved){
        $sheet->submitted = false;
        $this->Sheets->save($sheet);
    }

    if ($this->Meetings->delete($query) && $this->Sheets->save($sheet)) {
        $useremail =  $this->Users->get($query['user_id'])->extract(['email']);
        $username =  $this->Users->get($query['user_id'])->extract(['full_name']);
        $manageremail = $this->Users->get($query['manager_id'])->extract(['email']);
        $managername =  $this->Users->get($query['manager_id'])->extract(['full_name']);
        $to = $useremail['email'].', '.$manageremail['email'];
        $subject = 'Meeting for '.$username['full_name'].' has been rejected';
        $message = 'Dear '.$username['full_name'].',<br /><br / >Unfortunately, the meeting you have requested with '.$managername['full_name'].' hase been rejected, please login and resubmit your sheet with a different time. It would be advisable to contact '.$managername['full_name'].' and coordinate a meeting time before resubmitting';
        $email = new Email('default');
                        $email->from(['coaching@ab-controls.com' => 'ABC Coaching'])
                        ->to([$useremail['email'] => $username['full_name']])
                        ->subject($subject)
                        ->emailFormat('html')
                        ->send($message);
        $this->Flash->success(__('Meeting rejected.'));
        return $this->redirect($this->referer());
        }
    }
    public function accept_meeting($id) {
    $this->loadModel('Meetings');
    $this->loadModel('Sheets');
    $meeting = $this->Meetings->get($id);
    $meeting->status = "Accepted";
    $time = $meeting->time;
    $sheet = $this->Sheets->get($meeting->sheet_id);
    if ($this->Meetings->save($meeting)) {

            $this->loadModel('Users');
            $useremail =  $this->Users->get($sheet['user_id'])->extract(['email']);
            $username =  $this->Users->get($sheet['user_id'])->extract(['full_name']);
            $manageremail = $this->Users->get($sheet['manager_id'])->extract(['email']);
            $managername =  $this->Users->get($sheet['manager_id'])->extract(['full_name']);
            $to = $useremail['email'].', '.$manageremail['email'];
            $subject = $sheet['name'].' Meeting for '.$managername['full_name'].' and '.$username['full_name'];
            $organizer          = 'ABC Coaching';
            $organizer_email    = 'coaching@ab-controls.com';
            $participant_name_1 = $managername['full_name'];
            $participant_email_1= $manageremail['email'];
            $participant_name_2 = $username['full_name'];
            $participant_email_2= $useremail['email'];  
            $location = "http://coaching.ab-controls.com";
            $date = $time->year.$time->month.$time->day;
            $startTime = $time->hour.$time->minute;
            $endTime = $time->hour.$time->minute;
            $desc = 'You have a new meeting with your coach!';
            if($this->sendIcalEvent('ABC Coaching', 'coaching@ab-controls.com', $username['full_name'], $useremail['email'], $startTime, $endTime, $subject, $desc, $location, $date))
            {
                $desc = "You have a new meeting with your team member! Login to the <a href='http://coaching.ab-controls.com/team/'>ABC Coaching Website</a> to see all current meetings! Once you have had a meeting with your team member, you should approve their sheet so they can continue to the next step.";
                if($this->sendIcalEvent('ABC Coaching', 'coaching@ab-controls.com', $managername['full_name'], $manageremail['email'], $startTime, $endTime, $subject, $desc, $location, $date))
                {
                    $this->Flash->success(__('Sheet Sumbitted and Meetings sent!'));
                    return $this->redirect($this->referer());
                }
            }
        $this->Flash->success(__('Meeting Approved.'));
        return $this->redirect($this->referer());
        }
    }
    public function reject_sheet($sheetid)
    {
        $this->loadModel('Sheets');
        $sheet = $this->Sheets->get($sheetid);
        $sheet->submitted = false;
        if($this->Sheets->save($sheet))
        {
            $this->Flash->success(__('Sheet Rejected!'));
            return $this->redirect($this->referer());
        }
    }
    public function submit_sheet($sheetid){
        $this->loadModel('Sheets');
        $sheet =  $this->Sheets->get($sheetid);
        if(!$sheet->approved && !$sheet->submitted){
            $sheet->submitted = true;
            $sheet->approved = false;
            if($this->Sheets->save($sheet)){
                //email coach with link to pdf;
                $this->loadModel('Meetings');
                $meeting = $this->Meetings->newEntity();
                $meeting->sheet_id = $sheet['id'];
                if($this->Auth->user('id') == $sheet['user_id']){
                    $meeting->user_id = $sheet['user_id'];
                    $meeting->manager_id = $sheet['manager_id'];
                }else{
                    $meeting->user_id = $sheet['manager_id'];
                    $meeting->manager_id = $sheet['user_id'];
                }
                $meeting->status = "Pending";
                $time = $this->request->data;
                if($time['time']['meridian'] == 'pm'){
                    $time['time']['hour'] += 12;
                }
                $meeting->time = mktime($time['time']['hour'], $time['time']['minute'], 0,$time['date']['month'], $time['date']['day'], $time['date']['year']);
                if($this->Meetings->save($meeting)){
                    $this->Flash->success(__('Sheet Submitted and Meeting Proposed!'));
                    return $this->redirect(['controller' => 'forms', 'action' => 'index']);
                }
            }else
                {
                    $this->Flash->error(__('Could not Submit Sheet'));
                    return $this->redirect($this->referer());
                }
            }else
            {
            $this->Flash->error(__("Sheet not Submitted!"));
            return $this->redirect($this->referer());
            }
        }
       public function sendIcalEvent($from_name, $from_address, $to_name, $to_address, $startTime, $endTime, $subject, $description, $location, $date)
        {
            $domain = 'ab-controls.com';

            //Create Email Headers
            $mime_boundary = "----Meeting Booking----".MD5(TIME());

            $headers = "From: ".$from_name." <".$from_address.">\n";
            $headers .= "Reply-To: ".$from_name." <".$from_address.">\n";
            $headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
            $headers .= "Content-class: urn:content-classes:calendarmessage\n";
            
            //Create Email Body (HTML)
            $message = "--$mime_boundary\r\n";
            $message .= "Content-Type: text/html; charset=UTF-8\n";
            $message .= "Content-Transfer-Encoding: 8bit\n\n";
            $message .= "<html>\n";
            $message .= "<body>\n";
            $message .= '<p>Dear '.$to_name.',</p>';
            $message .= '<p>'.$description.'</p>';
            $message .= "</body>\n";
            $message .= "</html>\n";
            $message .= "--$mime_boundary\r\n";

            $ical = 'BEGIN:VCALENDAR' . "\r\n" .
            'PRODID:-//Microsoft Corporation//Outlook 10.0 MIMEDIR//EN' . "\r\n" .
            'VERSION:2.0' . "\r\n" .
            'METHOD:REQUEST' . "\r\n" .
            'BEGIN:VTIMEZONE' . "\r\n" .
            'TZID:Central Time' . "\r\n" .
            'BEGIN:STANDARD' . "\r\n" .
            'DTSTART:20091101T020000' . "\r\n" .
            'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=1SU;BYMONTH=11' . "\r\n" .
            'TZOFFSETFROM:-0500' . "\r\n" .
            'TZOFFSETTO:-0600' . "\r\n" .
            'TZNAME:EST' . "\r\n" .
            'END:STANDARD' . "\r\n" .
            'BEGIN:DAYLIGHT' . "\r\n" .
            'DTSTART:'.$date.'T'.$startTime.'00Z'."\r\n" .
            'RRULE:FREQ=YEARLY;INTERVAL=1;BYDAY=2SU;BYMONTH=3' . "\r\n" .
            'TZOFFSETFROM:-0600' . "\r\n" .
            'TZOFFSETTO:-0500' . "\r\n" .
            'TZNAME:CDST' . "\r\n" .
            'END:DAYLIGHT' . "\r\n" .
            'END:VTIMEZONE' . "\r\n" .  
            'BEGIN:VEVENT' . "\r\n" .
            'ORGANIZER;CN="'.$from_name.'":MAILTO:'.$from_address. "\r\n" .
            'ATTENDEE;CN="'.$to_name.'";ROLE=REQ-PARTICIPANT;RSVP=TRUE:MAILTO:'.$to_address. "\r\n" .
            'LAST-MODIFIED:' . date("Ymd\TGis") . "\r\n" .
            'UID:'.date("Ymd\TGis", strtotime($startTime)).rand()."@".$domain."\r\n" .
            'DTSTAMP:'.date("Ymd\TGis"). "\r\n" .
            'DTSTART;TZID="Central Time":'.date("Ymd\THis", strtotime($startTime)). "\r\n" .
            'DTEND;TZID="Central Time":'.date("Ymd\THis", strtotime($endTime.'+ 1 hour')). "\r\n" .
            'TRANSP:OPAQUE'. "\r\n" .
            'SEQUENCE:1'. "\r\n" .
            'SUMMARY:' . $subject . "\r\n" .
            'LOCATION:' . $location . "\r\n" .
            'CLASS:PUBLIC'. "\r\n" .
            'PRIORITY:5'. "\r\n" .
            'BEGIN:VALARM' . "\r\n" .
            'TRIGGER:-PT15M' . "\r\n" .
            'ACTION:DISPLAY' . "\r\n" .
            'DESCRIPTION:Reminder' . "\r\n" .
            'END:VALARM' . "\r\n" .
            'END:VEVENT'. "\r\n" .
            'END:VCALENDAR'. "\r\n";
            $message .= 'Content-Type: text/calendar;name="meeting.ics";method=REQUEST\n';
            $message .= "Content-Transfer-Encoding: 8bit\n\n";
            $message .= $ical;
            $email = new Email('default');
                        $email->from(['coaching@ab-controls.com' => 'ABC Coaching'])
                        ->to([$to_address => $to_name])
                        ->subject($subject)
                        ->emailFormat('text')
                        ->setHeaders([$headers])
                        ->attachments([
                        'meeting.ics' => [
                        'data' => $headers.$message,
                        'mimetype' => 'text/calender',
                        'contentId' => md5(uniqid(mt_rand(), true)).'.coaching.ab-controls.com',
                        'contentDisposition' => false]])
                        ->send($message);
                        return 1;

        }
    public function approve_sheet($sheetid){
        $this->loadModel('Sheets');
        $this->loadModel('Users');
        $sheet = $this->Sheets->get($sheetid);
        if(!$sheet->approved && $sheet->submitted){
            $sheet->submitted = false;
            $sheet->approved = true;
            $this->next_step($sheet->user_id);
            if($this->Auth->user('id') == $sheet->manager_id)
            {
                $user = $this->Users->get($sheet['manager_id']);
            }
            else{
                $user = $this->Users->get($sheet['user_id']);
            }
            if($this->Sheets->save($sheet)){

                $email = new Email('default');
                    $email->from(['coaching@ab-controls.com' => 'ABC Coaching'])
                    ->to($user['email'])
                    ->subject('Sheet approved for '.$user['full_name'].' at ABC Coaching')
                    ->emailFormat('html')
                    ->send('Dear '.$user['full_name'].', a sheet has been approved by you. Here is <a href="http://coaching.ab-controls.com/forms/view_sheet/'.$sheetid.'">a link</a> for your convinience. It is recommended that you logout and login if sheets will not update!');
                $this->Flash->success(__('Sheet Approved'));
                //email coach with link to pdf;

                return $this->redirect($this->referer());
            }
            else
            {
                $this->Flash->error(__('Could not Approve Sheet'));
                return $this->redirect($this->referer());
            }
        }else{
                    $this->Flash->error(__("Sheet could not be Approved!"));
                    return $this->redirect($this->referer());
                }
    }

    public function view_sheet($id){
        $this->loadModel('FormSections');
        $this->loadModel('FormItems');
        $this->loadModel('FormElements');
        $this->loadModel('Sheets');
        $this->loadModel('SheetItems');
        $this->loadModel('Files');
        $this->loadModel('Users');
        $files = $this->Files->find('all')->where(['sheet_id' => $id]);
        $sheet = $this->Sheets->get($id);
        //$authors = $this->Users->get($sheet['user_id'])->extract(['full_name']);
        $form = $this->Forms->get($sheet['form_id']);
        $formsections =  $this->FormSections->find('all')->where(['form_id' => $sheet['form_id']]);
        $formitems =  $this->FormItems->find('all');
        $sheetitems = $this->SheetItems->find('all')->where(['sheet_id' => $sheet['id']]);
        $formelements =  $this->FormElements->find('all');
        $this->set('formsections', $formsections);
        $this->set('formitems', $formitems);
        $this->set('formelements', $formelements);
        $this->set('form', $form);
        $this->set('sheet', $sheet);
        $this->set('sheetitems', $sheetitems);
        $this->set('files', $files);
        //$this->set('authors', $authors);


        $sheetelements = $this->FormElements->find('list')->where(['form_id' => $id])->select('name');
        $this->set('sheetelements', $sheetelements);
        $this->layout = 'print';

    }

    public function game_tree()
    {
    	$this->loadModel('Forms');
    	$this->loadModel('FormSections');
        $this->loadModel('FormItems');
        $this->loadModel('FormElements');
        $this->loadModel('Sheets');
        $this->loadModel('SheetItems');
        $this->loadModel('Files');
        $this->loadModel('Users');
        $tree = $this->Forms->find('all')->contain(['Sheets' => ['SheetItems']])->toArray();
        $this->set('tree', $tree);
        $this->layout = 'json';
    }
    private function next_step($userid)
    {
        $this->loadModel('Users');
        $user = $this->Users->get($userid);
        if($user->phase != 4)
        {
        $user->phase++;
        }
        $this->loadModel('Forms');
        $this->loadModel('Sheets');
                $form = $this->Forms->find()->select(['id', 'phase'])->where(['phase' => $user->phase])->first();
                //debug($form);
                if($form != null){
                    $this->new_sheet($form['id'], $userid);
                }
        if($this->Users->save($user)){
            
            return 1;
        }
        else{
            return 0;
        }

    }
}
?>