<?php
class ControllerUserControllerAttendance extends Controller {
    private $controller_group_id=16;
    public function __construct($params){ parent::__construct($params); $this->load->model('user/controller_attendance'); }
    private function isAllowed(){ return (int)$this->user->getGroupId()===$this->controller_group_id || (int)$this->user->getGroupId()===1 || $this->user->hasPermission('modify','user/controller'); }
    private function isSuperAdmin(){ return (int)$this->user->getGroupId()===1; }
    private function currentSlot($times){
        $now=strtotime(date('Y-m-d H:i:s'));
        foreach($times as $slot){
            $start=strtotime(date('Y-m-d').' '.$slot['meeting_time']);
            if($now >= $start && $now < $start+3600) return $slot;
        }
        return null;
    }
    public function index(){
        if(!$this->isAllowed()){ $this->response->redirect($this->url->link('error/permission','token='.$this->session->data['token'],'SSL')); return; }
        $times=$this->model_user_controller_attendance->getTimes(true);
        $is_admin=$this->isSuperAdmin() || $this->user->hasPermission('modify','user/controller');
        $current=$this->currentSlot($times);
        $selected=isset($this->request->get['meeting_time_id'])?(int)$this->request->get['meeting_time_id']:($current?(int)$current['id']:0);
        if(!$is_admin && $current) $selected=(int)$current['id'];
        if(!$is_admin && !$current) $selected=0;
        $date=date('Y-m-d');
        $data=array();
        $data['token']=$this->session->data['token']; $data['date']=$date; $data['times']=$times; $data['selected_id']=$selected;
        $data['current_slot']=$current; $data['is_admin']=$is_admin; $data['is_super_admin']=$this->isSuperAdmin();
        $data['counsellors']=$this->model_user_controller_attendance->getCounsellors();
        $data['attendance']=$selected?$this->model_user_controller_attendance->getAttendanceMap($date,$selected):array();
        $data['action']=$this->url->link('user/controller/attendance/save','token='.$this->session->data['token'],'SSL');
        $data['add_time']=$this->url->link('user/controller/attendance/add_time','token='.$this->session->data['token'],'SSL');
        $data['delete_time']=$this->url->link('user/controller/attendance/delete_time','token='.$this->session->data['token'],'SSL');
        $data['reload']=$this->url->link('user/controller/attendance','token='.$this->session->data['token'],'SSL');
        $data['history_from']=isset($this->request->get['history_from'])?$this->request->get['history_from']:date('Y-m-01');
        $data['history_to']=isset($this->request->get['history_to'])?$this->request->get['history_to']:date('Y-m-d');
        $data['history_counsellor']=isset($this->request->get['history_counsellor'])?(int)$this->request->get['history_counsellor']:0;
        $data['history']= $is_admin ? $this->model_user_controller_attendance->getHistory($data['history_from'],$data['history_to'],$data['history_counsellor']) : array();
        $data['header']=$this->load->controller('common/header'); $data['column_left']=$this->load->controller('common/column_left'); $data['footer']=$this->load->controller('common/footer');
        $this->document->setTitle('Counsellor Attendance');
        $this->response->setOutput($this->load->view('user/controller_attendance.tpl',$data));
    }
    public function save(){
        if(!$this->isAllowed()){ $this->json(array('error'=>'Permission denied.')); return; }
        $times=$this->model_user_controller_attendance->getTimes(true);
        $is_admin=$this->isSuperAdmin() || $this->user->hasPermission('modify','user/controller');
        $id=isset($this->request->post['meeting_time_id'])?(int)$this->request->post['meeting_time_id']:0; $slot=null;
        foreach($times as $t){ if((int)$t['id']===$id){$slot=$t;break;} }
        if(!$slot){$this->json(array('error'=>'Select a valid meeting time.'));return;}
        if(!$is_admin){$current=$this->currentSlot($times);if(!$current || (int)$current['id']!==$id){$this->json(array('error'=>'Attendance is available only during the first 60 minutes of the active meeting.'));return;}}
        $ids=isset($this->request->post['counsellor'])?(array)$this->request->post['counsellor']:array(); $added=0;
        foreach($ids as $cid){if(($cid=(int)$cid)>0 && $this->model_user_controller_attendance->addAttendance(date('Y-m-d'),$id,$cid,$this->user->getId()))$added++;}
        $this->json(array('success'=>$added.' attendance record(s) added. Existing records were not duplicated.'));
    }
    public function add_time(){
        if(!$this->isSuperAdmin()){$this->json(array('error'=>'Only Super Admin can add meeting times.'));return;}
        if($this->model_user_controller_attendance->addTime(isset($this->request->post['meeting_time'])?$this->request->post['meeting_time']:'') ){$this->json(array('success'=>'Meeting time added.'));return;}
        $this->json(array('error'=>'Invalid or duplicate meeting time.'));
    }
    public function delete_time(){
        if(!$this->isSuperAdmin()){$this->json(array('error'=>'Only Super Admin can delete meeting times.'));return;}
        if($this->model_user_controller_attendance->deleteTime(isset($this->request->post['id'])?(int)$this->request->post['id']:0)){$this->json(array('success'=>'Meeting time deleted.'));return;}
        $this->json(array('error'=>'This time cannot be deleted because attendance records already exist.'));
    }
    private function json($data){$this->response->addHeader('Content-Type: application/json');$this->response->setOutput(json_encode($data));}
}
