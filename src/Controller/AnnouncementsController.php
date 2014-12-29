<?
namespace App\Controller;

use App\Controller\AppController;

class AnnouncementsController extends AppController {

    public function index()
    {
        
    }
    public function view($id)
    {
        $announcement = $this->Announcements->get($id);
        $this->set(compact('announcement'));
    }
    public function edit()
    {
        
    }
}
?>