<?php

class UsersController extends AppController {

    var $uses = array('User', 'DepartmentMaster', 'SubscriptionMember', 'PlanFeature', 'TransactionHistory', 'DepartmentUser', 'SubscriptionPlan', 'CountryMaster', 'Visitor', 'UserLogin', 'Room', 'ThemeCustomization', 'DepartmentUser', 'Text', 'Shortcut', 'Brodcost', 'BrodcostStatus', 'UserRole');
    var $components = array('Paginator');

    public function checkUser() {
        if (!$this->Session->check('User')) {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        } else if ($this->Session->read('User.usertype') == 'operator') {
            $this->Session->destroy();
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        }
        $res = $this->Session->read('User');
        $company_id = $res['company_id'] != null ? $res['company_id'] : $res['id'];
        $subscipt = $this->SubscriptionMember->find('first', array(
            'conditions' => array(
                'user_id' => $company_id
            ),
            'order' => 'SubscriptionMember.id desc'
                )
        );
        if (time() > @$subscipt['SubscriptionMember']['end_date']) {
            $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('641', '0')));
            $this->redirect(array('controller' => 'Users', 'action' => 'upgrade'));
        }
    }

    public function index() {
        $this->checkUser();
        $this->redirect(array('controller' => 'Users', 'action' => 'Dashboard'));
        $this->layout = "company_layout";
        $this->set('title_for_layout', COMPANY_DASHBOARD);
        $this->loadmodel("User");
        $company_id = $this->Session->read('User.id');
        $this->paginate = array(
            'limit' => 10,
            'conditions' => array('User.company_id' => $company_id, 'User.status !=' => 4),
            'order' => array('id ASC')
        );
        //$res=$this->User->find('all',array('conditions'=>array('User.company_id'=>$company_id,'User.status !='=>4)));
        $res = $this->paginate('User');
        //pr($res);die;
        $dept_name = $this->DepartmentMaster->find('all', array('conditions' => array('company_id' => $company_id, 'status !=' => 3)));
        $nmlist = array();
        foreach ($dept_name as $deptList) {
            $nmlist[$deptList['DepartmentMaster']['id']] = $deptList['DepartmentMaster']['department_name'];
        }
        $this->set('view', $res);
        $this->set('nmlist', $nmlist);
        $this->loadmodel("UserLogin");
        $online = $this->UserLogin->query('select * FROM user_logins 
                                        where id in (select max(id) from user_logins 
                                                        where user_id in (select id from users where company_id ="' . $company_id . '")
                                                    )');
        $ListOnline = array();
        if (!empty($online)) {
            foreach ($online as $key => $value) {
                $ListOnline[$value['user_logins']['user_id']] = $value['user_logins']['is_login'];
            }
        }
        $this->set('ListOnline', $ListOnline);
    }

    public function Signup() {
        $this->layout = null;
        if (!$this->Session->check('Plan')) {
            if ($_SERVER['HTTP_HOST'] != 'localhost')
                $this->redirect('http://dachat.ir/Homes/Pricing');
            else
                $this->redirect('//localhost/chat/home/Homes/Pricing');
        }
        $this->set('plan', $this->Session->read('Plan.SubscriptionMember'));
        $this->set('title_for_layout', COMPANY_SIGNUP);
        if ($this->request->is('post')) {
            $data = $this->data;
            $validate = 0;
            if (!isset($data['User']['first_name']) || empty($data['User']['first_name'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('600', '0')));
                $validate++;
            } else if (!isset($data['User']['email']) || empty($data['User']['email'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('601', '0')));
                $validate++;
            } else if (!isset($data['User']['password']) || empty($data['User']['password'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('602', '0')));
                $validate++;
            } else if (!isset($data['User']['confirm_password']) || empty($data['User']['confirm_password'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('603', '0')));
                $validate++;
            } else if ($data['User']['password'] != $data['User']['confirm_password']) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('604', '0')));
                $validate++;
            } else if (!isset($data['User']['company_name']) || empty($data['User']['company_name'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('608', '0')));
                $validate++;
            } else if (!isset($data['User']['username']) || empty($data['User']['username'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('609', '0')));
                $validate++;
            } else if (!isset($data['User']['phone_number']) || empty($data['User']['phone_number'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('649', '0')));
                $validate++;
            } else if (!isset($data['User']['phone_number']) || !is_numeric($data['User']['phone_number'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('650', '0')));
                $validate++;
            }
            //email or username already registered
            $result = $this->User->find('first', array(
                'conditions' =>
                array(
                    'OR' => array(
                        'User.email' => $data['User']['email'],
                        'User.username' => $data['User']['username']
                    ),
                    'User.status !=' => 4
                )
                    )
            );
            if (!empty($result)) {
                if ($result['User']['email'] == $data['User']['email']) {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('610', '0')));
                    $validate++;
                } else if ($result['User']['username'] == $data['User']['username']) {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('611', '0')));
                    $validate++;
                }
            }
            $data['User']['password'] = md5($data['User']['password']);
            unset($data['User']['confirm_password']);
            $data['User']['status'] = 3;
            $data['User']['verification_link'] = $data['User']['email'];
            if ($validate == 0) {
                if ($this->User->save($data)) {

                    $roleData['role_id'] = 2;
                    $roleData['add_date'] = time();
                    $roleData['modify_date'] = time();
                    $roleData['user_id'] = $this->User->getLastInsertId();
                    $this->UserRole->save($roleData);

                    $this->UserRole->create();
                    $roleData['role_id'] = 3; // role for Agent
                    $this->UserRole->save($roleData);

                    $this->loadModel('DepartmentMaster');
                    $dMasterData['company_id'] = $this->User->getLastInsertId();
                    $dMasterData['department_name'] = 'default';
                    $dMasterData['status'] = '1';
                    $dMasterData['add_date'] = time();
                    $dMasterData['modify_date'] = time();
                    $this->DepartmentMaster->save($dMasterData);

                    $this->loadModel('DepartmentUser');
                    $dUserData['user_id'] = $this->User->getLastInsertId();
                    $dUserData['company_id'] = $this->User->getLastInsertId();
                    $dUserData['department_id'] = $this->DepartmentMaster->getLastInsertId();
                    $dUserData['status'] = '1';
                    $dUserData['add_date'] = time();
                    $this->DepartmentUser->save($dUserData);

                    $this->Session->delete('Plan');
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('700', '1')));
                    $subject = "Hello " . $data['User']['first_name'] . " " . $data['User']['last_name'] . " Your Registration Successfully";
                    $link = WEB_PATH . '/users/EmailConfirmation/' . base64_encode($data['User']['email']);
                    $msg = "<div><a href='" . $link . "' style='text-decoration:none;color:blue'>" . 'Click here to Activate Your Account.' . "</a></div>";
                    $mail = $data['User']['email'];
                    App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail('smtp');
                    $Email->emailFormat('html');
                    $Email->from(array('support@nextolive.com' => 'Dachat'));
                    $Email->to($mail);
                    $Email->subject($subject);
                    $Email->template('signup');
                    $Email->send($msg);
                    $this->redirect(array('controller' => 'Users', 'action' => 'SignupSuccess'));
                }
            }
        }
    }

    public function SignupSuccess() {
        $this->layout = null;
        $this->set('title_for_layout', 'Registration landing page');
    }
    
    public function login() {

        $this->layout = null;
        $this->set('title_for_page', COMPANY_LOGIN);
        $this->loadmodel('UserLogin');
        /*if ($this->Session->check('User')) {
            if ($this->Session->read('User.usertype') == 'company') {
                $this->redirect(array('controller' => 'Users', 'action' => 'Dashboard'));
            } else if ($this->Session->read('User.usertype') == 'operator') {
                $this->redirect(array('controller' => 'Operators', 'action' => 'index'));
            }
        }*/

        if ($this->request->is('post')) {
            $data = $this->data;
            $user = isset($data['User']['username']) ? $data['User']['username'] : '';
            $pass = isset($data['User']['password']) ? $data['User']['password'] : '';
            if (isset($user) && isset($pass)) {
                $res = $this->User->find('first', array(
                    'joins' => array(
                        array(
                            'table' => 'user_roles',
                            'alias' => 'UserRole',
                            'type' => 'INNER',
                            'conditions' => array(
                                'UserRole.user_id = User.id'
                            )
                        )
                    ),
                    'conditions' =>
                    array(
                        'User.username' => $user,
                        'User.password' => md5($pass),
                        'status !=' => 4,
                        'UserRole.role_id' => 2
                    ),
                    'fields' => 'UserRole.* , User.*'
                        )
                );
                if (!empty($res)) {
                    $UserLogin = array();
                    $UserLogin['user_id'] = $res['User']['id'];
                    $UserLogin['login_time'] = time();
                    $UserLogin['is_login'] = 1;
                    $UserLogin['marked'] = 2;
                    $UserLogin['add_date'] = time();
                    if ($res['UserRole']['role_id'] == 3) {
                        if ($res['User']['status'] == 2) {
                            $res['User']['usertype'] = 'operator';
                            $this->Session->write('User', $res['User']);
                            $this->UserLogin->save($UserLogin);
                            $this->redirect(array('controller' => 'Operators', 'action' => 'index'));
                        }
                    } else if ($res['UserRole']['role_id'] == 2) {
                        if ($res['User']['status'] == 2) {
                            $this->UserLogin->save($UserLogin);
                            $res['User']['usertype'] = 'company';
                            $this->Session->write('User', $res['User']);
                            if ($this->Session->check('Plan')) {
                                $plan_data = $this->Session->read('Plan');
                                $plan_data['SubscriptionMember']['user_id'] = $res['User']['id'];
                                $plan_data['SubscriptionMember']['txn_id'] = uniqid();
                                $plan_data['SubscriptionMember']['status'] = 1;
                                $res_plan = $this->SubscriptionMember->find('first', array('conditions' => array('user_id' => $plan_data['SubscriptionMember']['user_id'])));
                                if (!empty($res_plan)) {
                                    $this->redirect(array('controller' => 'Users', 'action' => 'PlansBilling'));
                                } else {
                                    $this->Session->write('Plan', $plan_data);
                                    $this->redirect(array('controller' => 'Users', 'action' => 'changeplanbilling'));
                                }
                            }
                            $this->redirect(array('controller' => 'Users', 'action' => 'Dashboard'));
                        }
                    }

                    if ($res['User']['status'] == 1) {
                        $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('605', '0')));
                    } else if ($res['User']['status'] == 3) {
                        $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('606', '0')));
                    }
                } else {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('607', '0')));
                }
            }
        }
    }

    public function dashboard() {
        $this->checkUser();
        $count = 0;
        $this->layout = "company_parsion_layout";
        $this->set('title_for_layout', COMPANY_DASHBOARD);
        $company_id = $this->Session->read('User.id');
        $total_operator = $this->User->find('count', array('conditions' => array('User.company_id' => $company_id, 'User.status !=' => 4)));
        if (!empty($total_operator)) {
            $this->set('totaloperator', $total_operator);
        }
        $visitor = $this->Visitor->find('count');
        if (!empty($visitor)) {
            $this->set('visitor_online', $visitor);
        }
        $online = $this->UserLogin->query("select count(*) as 'online' from user_logins,users  where user_logins.is_login=1 and user_logins.user_id=users.id and users.company_id='" . $company_id . "'");
        //pr($online);die;
        $all_conversation = $this->UserLogin->query("select count(*)as 'total' from users,user_logins where user_logins.user_id=users.company_id and users.company_id='" . $company_id . "'");
        $active_conversation = $this->Room->query("SELECT count(*) as 'active' from rooms,messages,users where rooms.room_id=messages.room_id and rooms.user_id=users.id and users.company_id='" . $company_id . "' and rooms.is_active=1");
        $all_conversation = $this->Room->query("SELECT count(*) as 'all_conversation' from rooms,messages,users where rooms.room_id=messages.room_id and rooms.user_id=users.id and users.company_id='" . $company_id . "'");
        $company_name = $this->Session->read('User.company_name');
        $this->set('company_name', $company_name);
        $active_department = $this->DepartmentMaster->find('count', array('conditions' => array('company_id' => $company_id, 'status' => 1)));
        $total_department = $this->DepartmentMaster->find('count', array('conditions' => array('company_id' => $company_id)));
        $plan = $this->SubscriptionMember->query("SELECT * from subscription_members,subscription_plans where subscription_plans.id=subscription_members.plan_id and subscription_members.status=1 and subscription_members.user_id='" . $company_id . "' ORDER BY `subscription_members`.`id` DESC");
        $this->set('plan_name', @$plan[0]['subscription_plans']['plan_name']);
        $this->set('plan_start_date', date('Y-m-d', @$plan[0]['subscription_members']['start_date']));
        $this->set('plan_end_date', date('Y-m-d', @$plan[0]['subscription_members']['end_date']));
        $this->set('total_department', $total_department);
        $this->set('active_department', $active_department);
        //pr($company_name);die;
        if (!empty($all_conversation)) {
            $this->set('all_conversation', $all_conversation[0][0]['all_conversation']);
        }
        if (!empty($active_conversation)) {
            //pr($active_conversation[0][0]['active']);die;
            $this->set('active', $active_conversation[0][0]['active']);
        }

        if (!empty($online)) {
            $this->set('online_operator', $online[0][0]['online']);
        }
    }

    public function visual() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
    }

    public function texts() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');
        if ($this->request->is('post')) {
            $data = $this->data;

            if ((!empty($data['Text']['before_talk'])) && (!empty($data['Text']['welcome_message'])) && (!empty($data['Text']['closing_message']))) {
                $data['Text']['company_id'] = $company_id;
                $data['Text']['status'] = 1;
                $data['Text']['add_date'] = strtotime(date('Y-m-d H:i:s'));
                $data['Text']['modify_date'] = strtotime(date('Y-m-d H:i:s'));
                $this->Text->save($data);
                echo 1;
                die;
            } else {
                echo 0;
                die;
            }
        }
    }

    public function MessageGet() {

        //$this->checkUser();
        $company_id = $this->Session->read('User.id');
        $res = $this->Brodcost->query("select * from brodcosts where status=2 and company_id='" . $company_id . "' order by add_date desc limit 3");

        return $res;
    }

    public function GetCountMessage() {
        //$this->checkUser();
        $company_id = $this->Session->read('User.id');
        $res = $this->Brodcost->query("select count(*) as 'ttl' from brodcosts where status=2 and company_id='" . $company_id . "' order by add_date desc limit 3");
        return $res;
    }

    function GenerateScript() {
        $this->checkUser();
        $this->layout = null;
        $this->set('title_for_layout', 'Get Script');
    }

    public function inbox() {
        $this->checkUser();

        if (isset($this->params->pass[0])) {
            $result = array();
            $ide = base64_decode($this->params->pass[0]);
            $company_id = $this->Session->read('User.id');
            $ttl_msg = $this->Brodcost->query("select count(*) as 'total' from brodcosts where status=2 and company_id='" . $company_id . "'");
            $data = $this->Brodcost->findById($ide);
            $result['brodcost'] = $data;
            $result['brodcost']['ttl'] = $ttl_msg[0][0]['total'];
            echo json_encode($result);
            $data['Brodcost']['status'] = 1;
            $this->Brodcost->save($data);
            die;
        }
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');
        $this->paginate = array(
            'limit' => 10,
            'conditions' => array('Brodcost.company_id' => $company_id, 'Brodcost.status !=' => 3),
            'order' => array('add_date desc')
        );
        $res = $this->paginate('Brodcost');
        if (!empty($res)) {
            //pr($res);die;
            $this->set('view', $res);
        }
    }

    public function BrodCostStatus() {
        if (isset($this->params->pass[0])) {
            $ide = base64_decode($this->params->pass[0]);
            $res = $this->Brodcost->findById($ide);
            if (!empty($res)) {
                $res['Brodcost']['status'] = 3;
                $res['Brodcost']['modify_date'] = strtotime(date('Y-m-d H:i:s'));
                $this->Brodcost->save($res);
                echo 1;
                die;
            } else {
                echo 2;
                die;
            }
        }
    }

    public function upgrade() {
        //$this->checkUser();
        $this->layout = "company_parsion_layout";
        $res = $this->SubscriptionPlan->find('all', array('conditions' => array('status' => 1)));
        //pr($res);die;
        if ($this->request->is('post')) {
            $data = $this->data;
            $id = $data['SubscriptionPlan']['id'];

            $this->Session->write('PurchasePlan', $id);
            $this->Session->delete('Plan');
            $this->redirect(array('controller' => 'Users', 'action' => 'changeplanbilling'));
        }
        $this->set('view_plan', $res);
    }

    public function ReportDepartment() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');
        $department = $this->DepartmentMaster->find('all', array('conditions' => array('status ' => 1, 'company_id' => $company_id)));
        $dept_name = array();
        if (!empty($department)) {
            foreach ($department as $nm_list) {
                $dept_name[$nm_list['DepartmentMaster']['id']] = $nm_list['DepartmentMaster']['department_name'];
            }

            $this->set('name_list', $dept_name);
        }
        if (!empty($dept_name)) {

            $res = $this->Room->find('all', array(
                'fields' => 'count(Room.id) as c, Room.department_id',
                'conditions' => array('Room.user_id !=' => '', 'Room.is_active' => 2, 'Room.department_id' => array_keys($dept_name)),
                'group' => array('Room.department_id')
                    )
            );
            $depart_report = array();
            if (!empty($res)) {
                foreach ($res as $key => $value) {
                    $depart_report[$value['Room']['department_id']] = $value[0]['c'];
                }
            }
            $this->set('depart_report', $depart_report);
            $duration = $this->Room->query('Select SUM(du)  AS CreditTotal , main.*  from (
                                                SELECT min(messages.add_date)as op,max(messages.modify_date)as cl,
                                                max(modify_date) - min(messages.add_date) as du , R.department_id
                                                FROM `messages` 
                                                inner join rooms R on R.room_id=messages.room_id
                                                group by R.room_id
                                                order by R.department_id
                                            )main
                                            where main.department_id in(' . implode(",", array_keys($dept_name)) . ')
                                            group by main.department_id '
            );
            $duration_report = array();
            if (!empty($duration)) {
                foreach ($duration as $key => $value) {
                    $duration_report[$value['main']['department_id']] = $value[0]['CreditTotal'];
                }
            }
            $this->set('duration_report', $duration_report);
        }
    }

    /*
     *  function to get bar chart mostly used in ReportDepartment 
     *  @INPUT PARAMETERS $department_id, MOnth and Year(goeargion)
     *  Request Type Ajax or requestAction
     */

    public function BarchartDept() {
        $this->autoRender = false;
        $res = array();
        if (isset($this->request->query['date'])) {
            //call via ajax from report view.ctp
            $resgeo = $this->requestAction(array('controller' => 'Cpanels', 'action' => 'jalali_to_gregorian'), array('data' => array('date' => $this->params->named['date'])));
            //$ctime = strtotime($resgeo);
            $st = strtotime($resgeo);
            $et = strtotime("+1 month", strtotime($resgeo));
            if (substr($this->params->named['date'], 5, 2) <= 6) {
                $res['et'] = 31;
            } else if ((substr($this->params->named['date'], 5, 2) > 6 ) && (substr($this->params->named['date'], 5, 2) <= 11)) {
                $res['et'] = 30;
            } else {
                $res['et'] = 29;
            }
        } else if (isset($this->params->named['date'])) {
            //call via requestAction
            $ctime = strtotime($this->params->named['date']);
            $st = strtotime(date('Y-m-01', $ctime));
            $et = strtotime(date('Y-m-t', $ctime));
            $res['et'] = date('t', $ctime);
        }
        $dept = $this->params->named['dept'][0];
        $res['data'] = $this->Room->find('all', array(
            'fields' => 'count(Room.id) as c, FROM_UNIXTIME(add_date,"%Y-%m-%d") as ti',
            'conditions' => array('Room.user_id !=' => '', 'Room.is_active' => 2, 'Room.department_id' => $dept, 'add_date >=' => $st, 'add_date <=' => $et),
            'group' => 'ti'
                )
        );
        foreach ($res['data'] as $key => $value) {
            $res['data'][$key][0]['ti'] = $this->requestAction(array('controller' => 'Cpanels', 'action' => 'gregorian_to_jalali'), array('named' => array('date' => $value[0]['ti'])));
        }

        return json_encode($res);
    }

    public function support() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');
        $da = $this->User->findById($company_id);

        $res = $this->DepartmentMaster->find('all', array('conditions' => array('status !=' => 3, 'company_id' => $company_id)));
        if ($this->request->is('post')) {
            $data = $this->data;
            if ((!empty($data['abc']['department'])) && (!empty($data['abc']['title'])) && (!empty($data['abc']['description']))) {
                $dept_id = $data['abc']['department'];
                $department_data = $this->DepartmentMaster->findById($dept_id);
                $department_name = $department_data['DepartmentMaster']['department_name'];
                $title = $data['abc']['title'];
                $description = $data['abc']['description'];

                //======================================Send Mail ===================================
                $subject = "Hello " . $department_name;
                $mail = $department_name . "@dachat.ir";
                $Email = new CakeEmail('smtp');
                $Email->emailFormat('html');
                $Email->from(array($da['User']['email'] => 'Dachat'));
                $Email->to($mail);
                $Email->subject($title);
                if ($Email->send($description)) {
                    echo "1";
                    die;
                } else {
                    echo "0";
                    die;
                }
            } else {
                echo "2";
                die; //please fill the blank fields
            }
        }

        $dept_name = array();
        if (!empty($res)) {
            foreach ($res as $nm_list) {
                $dept_name[$nm_list['DepartmentMaster']['id']] = $nm_list['DepartmentMaster']['department_name'];
            }
            $this->set('name_list', $dept_name);
        }
        //pr($dept_name);die;
    }

    public function billing() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
    }

    public function AgentReport() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');

        $agents = $this->User->find('all', array('conditions' => array('status ' => 2, 'company_id' => $company_id)));
        $agent_name = array();
        if (!empty($agents)) {
            foreach ($agents as $nm_list) {
                $agent_name[$nm_list['User']['id']] = $nm_list['User']['username'];
            }

            $this->set('name_list', $agent_name);
        }
    }

    public function department() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $this->set('title_for_layout', COMPANY_DEPART);
        $company_id = $this->Session->read('User.id');


        $department_name = $this->DepartmentMaster->find('all', array('conditions' => array('DepartmentMaster.company_id' => $company_id, 'DepartmentMaster.status !=' => 3)));
        //pr($department_name);die;
        $this->set('department_name', $department_name);
        $activeagent = array();
        $totalagent = array();
        if (!empty($department_name)) {
            foreach ($department_name as $deptList) {
                $activeagent[$deptList['DepartmentMaster']['id']] = $this->DepartmentUser->query("select count(user_id) as 'active'  from department_users where department_id='" . $deptList['DepartmentMaster']['id'] . "' and status =1 and company_id='" . $company_id . "'");
                $totalagent[$deptList['DepartmentMaster']['id']] = $this->DepartmentUser->query("select count(user_id) as 'deactive'  from department_users where department_id='" . $deptList['DepartmentMaster']['id'] . "' and status !=3 and company_id='" . $company_id . "'");
            }
            //========================Hear total agent,active agent in every Department========//
            //pr($activeagent);die;
            $this->set('Activeagent', $activeagent);
            $this->set('Totalagent', $totalagent);
        }
        //pr($total_operator);
        //pr($active_operator);die;
    }

    function DepartList() {
        $this->autoRender = false;
        $this->checkUser();
        $validate = 0;
        $this->layout = "company_layout";
        $this->set('title_for_layout', COMPANY_DEPART);
        $company_id = $this->Session->read('User.id');

        if (isset($this->data['deptt'])) {


            if (empty($this->data['deptt']['department_name'])) {
                echo 0;
                die;
            }
            $check = $this->DepartmentMaster->find('first', array('conditions' => array('department_name' => $this->data['deptt']['department_name'], 'status !=' => 3)));
            if (!empty($check)) {
                echo 2;
                die;
            }
            $AllowedDeptt = $this->DepartmentMaster->query("select department FROM plan_features 
                            where plan_id = (select plan_id from subscription_members 
                                                where user_id='" . $company_id . "' and status=1 order by id desc limit 1)");
            $CurrentDeptt = $this->DepartmentMaster->find('count', array(
                'conditions' => array(
                    'company_id' => $company_id,
                    'status' => 1
                )
                    )
            );

            $dataArray = array();
            if (@$AllowedDeptt[0]['plan_features']['department'] == 1 && @$CurrentDeptt < 1) {
                $dataArray['status'] = 1;
            } else if (@$AllowedDeptt[0]['plan_features']['department'] == 2 && @$CurrentDeptt < 3) {
                $dataArray['status'] = 1;
            } else if (@$AllowedDeptt[0]['plan_features']['department'] == 3 && @$CurrentDeptt < 5) {
                $dataArray['status'] = 1;
            } else if (@$AllowedDeptt[0]['plan_features']['department'] == 4) {
                $dataArray['status'] = 1;
            } else {
                $dataArray['status'] = 2;
            }

            $dataArray['company_id'] = $company_id;
            $dataArray['department_name'] = $this->data['deptt']['department_name'];
            $dataArray['add_date'] = time();
            $dataArray['modify_date'] = time();
            if ($validate == 0) {
                //save into db
                $this->DepartmentMaster->save($dataArray);
                echo 1;
                die;
            }
        }
        $res = $this->DepartmentMaster->find('all', array('conditions' => array('status !=' => 3, 'company_id' => $company_id)));
        if (!empty($res)) {
            $this->set('department_name', $res);
        }
    }

    public function shortcuts() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        //$this->autoRender=false;
        $this->loadmodel('Shortcut');
        $company_id = $this->Session->read('User.id');
        $res = $this->Shortcut->find('all', array('conditions' => array('company_id' => $company_id, 'status !=' => 3)));
        //pr($res);die;
        if ($this->request->is('post')) {
            $data = $this->data;
            if ((!empty($data['short_code'])) && (!empty($data['full_text']))) {
                $check = $this->Shortcut->find('first', array('conditions' => array('short_code' => $data['short_code'])));
                if (!empty($check)) {
                    echo 2;
                    die;
                }
                $data['Shortcut'] = $data;
                $data['Shortcut']['company_id'] = $company_id;
                $data['Shortcut']['status'] = 1;
                $data['Shortcut']['add_date'] = strtotime(date('Y-m-d H:i:s'));
                $data['Shortcut']['modify_date'] = strtotime(date('Y-m-d H:i:s'));
                $this->Shortcut->save($data);
                echo 1;
                die;
            } else {
                echo 0;
                die;
            }
        }
        $this->set('view', $res);
    }

    public function DeleteShortcut() {
        if (!empty($this->params->pass[0])) {
            $ide = base64_decode($this->params->pass[0]);
            $res = $this->Shortcut->findById($ide);
            $res['Shortcut']['status'] = 3;
            $res['Shortcut']['modify_date'] = strtotime(date('Y-m-d H:i:s'));
            $this->Shortcut->save($res);
            echo 1;
            die;
        }
    }

    public function EditShortcut() {
        if (!empty($this->params->pass[0])) {
            $ide = base64_decode($this->params->pass[0]);
            $res = $this->Shortcut->findById($ide);
            echo json_encode($res);
            die;
        }
        if ($this->request->is('post')) {
            $data = $this->data;

            $data['Shortcut'] = $data;
            if ((!empty($data['Shortcut']['short_code'])) && (!empty($data['Shortcut']['full_text']))) {

                $data['Shortcut']['modify_date'] = strtotime(date('Y-m-d H:i:s'));
                $this->Shortcut->save($data);
                echo 1;
                die;
            } else {
                echo 0;
                die;
            }
        }
    }

    public function save_color() {
        $this->checkUser();
        $data = array();
        $this->autoRender = false;
        if (isset($this->params->pass[0])) {

            $color = base64_decode($this->params->pass[0]);

            $company_id = $this->Session->read('User.id');
            $res = $this->ThemeCustomization->find('first', array('conditions' => array('company_id' => $company_id)));
            if (!empty($res)) {
                $data['ThemeCustomization']['id'] = $res['ThemeCustomization']['id'];
                $data['ThemeCustomization']['theme_color'] = $color;
                $data['ThemeCustomization']['modify_date'] = date('Y-m-d H:i:s');
                if ($this->ThemeCustomization->save($data)) {
                    //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                    //array('pass'=>array('815','1')));
                    //$this->redirect(array('controller'=>'Users','action'=>'visual'));
                    echo 1;
                    die;
                }
            } else {
                $data['ThemeCustomization']['company_id'] = $company_id;
                $data['ThemeCustomization']['theme_color'] = $color;
                $data['ThemeCustomization']['add_date'] = date('Y-m-d H:i:s');
                $data['ThemeCustomization']['modify_date'] = date('Y-m-d H:i:s');
                if ($this->ThemeCustomization->save($data)) {
                    //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                    //array('pass'=>array('815','1')));
                    //$this->redirect(array('controller'=>'Users','action'=>'visual'));
                    echo 2;
                    die;
                }
            }
        } else {
            echo 0;
            die;
            //$this->redirect(array('controller'=>'Users','action'=>'visual')); 
        }
    }

    public function agents() {
        $this->checkUser();
        $this->layout = "company_parsion_layout";
        $company_id = $this->Session->read('User.id');
        $this->paginate = array(
            'limit' => 10,
            'conditions' => array(
                                
                                'OR'=>array(
                                  'User.company_id' => $company_id,
                                  'User.id' => $company_id,
                                ),
                                 'User.status !=' => 4,
                                 'UserRole.role_id' => 3
                                
                ),
            'joins' => array(
                                array(
                                    'table' => 'user_roles',
                                    'alias' => 'UserRole',
                                    'type' => 'INNER',
                                    'conditions' => array(
                                        'UserRole.user_id = User.id'
                                    )
                                )
                            ),
            'order' => array('id ASC')
        );
        //$res=$this->User->find('all',array('conditions'=>array('User.company_id'=>$company_id,'User.status !='=>4)));
        $res = $this->paginate('User');
        //pr($res);die;
        $operator = array();
        $o = array();
        $st = null;
        foreach ($res as $r) {
            array_push($operator, $r['User']['id']);
        }

        if (!empty($operator)) {
            $o = $this->DepartmentMaster->query("SELECT dm.*, du.user_id FROM `department_masters` as dm , department_users as du where dm.id in(select department_id from department_users where status =1 and user_id in(" . implode($operator, ',') . ") and company_id='" . $company_id . "') and dm.status=1 and dm.id = du.department_id and du.status=1");
        }
        //pr($o);die;
        $nmlist = array();
        if (!empty($o)) {
            foreach ($o as $deptList) {

                if (isset($nmlist[$deptList['du']['user_id']])) {
                    $nmlist[$deptList['du']['user_id']] .= ', ' . $deptList['dm']['department_name'];
                } else {
                    $nmlist[$deptList['du']['user_id']] = $deptList['dm']['department_name'];
                }
            }
        }

        $this->set('nmlist', $nmlist);

        //$o=$this->DepartmentMaster->query("SELECT department_name as 'dept_name' FROM `department_masters` where id in (select department_id from department_users where status!=3 and user_id in (".implode($operator,',').") and company_id=1) and status!=3");
        //pr($x);die;
        $department = $this->DepartmentMaster->find('all', array('conditions' => array('status' => 1, 'company_id' => $company_id)));
        //pr($department);die;
        if (!empty($department)) {
            $this->set('department_name', $department);
        }
        if (!empty($res)) {
            $this->set('view_data', $res);
        }
    }

    public function logout() {

        $this->autoRender = false;
        //$this->Session->delete('User');
        $this->Session->destroy();
        $this->redirect(array('controller' => 'Users', 'action' => 'login'));
    }

    public function AddOperator() {
        $this->checkUser();
        $arr = array();
        $dept_name = array();
        $company_id = $this->Session->read('User.id');
        $len = 0;



        //foreach($dept_res as $nm_list){
        // $dept_name[$nm_list['DepartmentMaster']['id']]=$nm_list['DepartmentMaster']['department_name'];
        //}
        //$this->set('name_list',$dept_name);
        //pr($dept_name);die;
        if ($this->request->is('post')) {

            $data = $this->data;
            if (!isset($data['selector'])) {
                echo "0";
                die;
            }
            //pr($data['selector']);die;
            $len = count($data['selector']);



            $validate = 0;
            if (!isset($data['User']['first_name']) || empty($data['User']['first_name'])) {
                //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                //array('pass'=>array('600','0')));
                $validate++;
                echo "0";
                die;
            } else if (!isset($data['User']['email']) || empty($data['User']['email'])) {
                //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                //array('pass'=>array('601','0')));
                $validate++;
                echo "0";
                die;
            } else if (!isset($data['User']['password']) || empty($data['User']['password'])) {
                //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                // array('pass'=>array('602','0')));
                $validate++;
                echo "0";
                die;
            } else if (!isset($data['User']['confirm_password']) || empty($data['User']['confirm_password'])) {
                // $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                /// array('pass'=>array('603','0')));
                $validate++;
                echo "0";
                die;
            } else if ($data['User']['password'] != $data['User']['confirm_password']) {
                //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                // array('pass'=>array('604','0')));
                $validate++;
                echo "4";
                die; //Password and confirm password does not match 
            } else if (!isset($data['User']['username']) || empty($data['User']['username'])) {
                // $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                //array('pass'=>array('609','0')));
                $validate++;
                echo "0";
                die;
            }

            //email or username already registered
            $result = $this->User->find('first', array(
                'conditions' =>
                array(
                    'OR' => array(
                        'User.email' => $data['User']['email'],
                        'User.username' => $data['User']['username']
                    ),
                    'User.status !=' => 4
                )
                    )
            );

            if (!empty($result)) {
                if ($result['User']['email'] == $data['User']['email']) {
                    //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                    // array('pass'=>array('610','0')));
                    $validate++;
                    echo "3";
                    die;  //Email Already Exists
                } else if ($result['User']['username'] == $data['User']['username']) {
                    //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                    // array('pass'=>array('611','0')));
                    $validate++;
                    echo "2";
                    die;  //2 code user name Already Exists
                }
            }
            $data['User']['password'] = md5($data['User']['password']);

            unset($data['User']['confirm_password']);
            $data['User']['status'] = 3;
            if ($validate == 0) {
                $data['User']['company_id'] = $this->Session->read('User.id');
                $data['User']['verification_link'] = $data['User']['email'];

                if ($this->User->save($data)) {
                    $roleData['role_id'] = 3;
                    $roleData['add_date'] = time();
                    $roleData['modify_date'] = time();
                    $roleData['user_id'] = $this->User->getLastInsertId();
                    ;
                    $this->UserRole->save($roleData);

                    $da = array();

                    for ($a = 0; $a < $len; $a++) {
                        $user_id1 = $this->User->getLastInsertId();
                        $da['DepartmentUser']['user_id'] = $user_id1;
                        $da['DepartmentUser']['company_id'] = $company_id;
                        $da['DepartmentUser']['department_id'] = $data['selector'][$a];
                        $da['DepartmentUser']['status'] = 1;

                        $da['DepartmentUser']['add_date'] = strtotime(date('Y-m-d'));
                        $this->DepartmentUser->save($da);
                        unset($da['DepartmentUser']['department_id']);
                    }


                    $subject = "Hello " . $data['User']['first_name'] . " " . $data['User']['last_name'] . " Your Registration Successfully";
                    $link = WEB_PATH . '/users/EmailConfirmation/' . base64_encode($data['User']['email']);
                    $msg = "<div><a href='" . $link . "' style='text-decoration:none;color:blue'>" . 'Click here to Activate Your Account.' . "</a></div>";
                    $mail = $data['User']['email'];
                    $Email = new CakeEmail('smtp');
                    $Email->emailFormat('html');
                    $Email->from(array('support@nextolive.com' => 'Dachat'));
                    $Email->to($mail);
                    $Email->subject($subject);
                    $Email->send($msg);
                    //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                    //array('pass'=>array('701','1')));
                    //$this->redirect(array('controller'=>'Users','action'=>'agents'));
                    echo "1";
                    die;
                }
            }
        }
    }

    /*
      public function AddOperator(){
      $this->checkUser();
      $this->layout="company_layout";
      $this->set('title_for_layout',OPERATOR_ADD);
      if($this->request->is('post')){
      $data=$this->data;
      $validate =0;
      if( !isset($data['User']['first_name']) || empty($data['User']['first_name'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('600','0')));
      $validate++;
      }else if(!isset($data['User']['email']) || empty($data['User']['email'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('601','0')));
      $validate++;
      }else if(!isset($data['User']['password']) || empty($data['User']['password'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('602','0')));
      $validate++;
      }else if(!isset($data['User']['confirm_password']) || empty($data['User']['confirm_password'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('603','0')));
      $validate++;
      }else if($data['User']['password'] != $data['User']['confirm_password']){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('604','0')));
      $validate++;
      }else if(!isset($data['User']['username']) || empty($data['User']['username'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('609','0')));
      $validate++;
      }

      //email or username already registered
      $result = $this->User->find('first',
      array(
      'conditions'=>
      array(
      'OR'=>array(
      'User.email'=>$data['User']['email'],
      'User.username'=>$data['User']['username']
      ),
      'User.status !='=>4
      )
      )
      );

      if(!empty($result)){
      if($result['User']['email']==$data['User']['email']){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('610','0')));
      $validate++;
      }else if($result['User']['username']==$data['User']['username']){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('611','0')));
      $validate++;
      }
      }
      $data['User']['password'] = md5($data['User']['password']);
      unset($data['User']['confirm_password']);
      $data['User']['status']=3;
      if($validate==0){
      $data['User']['verification_link']=$data['User']['email'];
      $data['User']['company_id']=$this->Session->read('User.id');
      if($this->User->save($data)){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('701','1')));
      $subject ="Hello ".$data['User']['first_name']." ".$data['User']['last_name']." Your Registration Successfully";
      $link=WEB_PATH.'/Users/EmailConfirmation/'.base64_encode($data['User']['email']);
      $msg="<div><a href='".$link."' style='text-decoration:none;color:blue'>".'Click here to Activate Your Account.'."</a></div>";
      $mail=$data['User']['email'];
      $Email = new CakeEmail('smtp');
      $Email->emailFormat('html');
      $Email->from(array('support@nextolive.com' => 'Dachat'));
      $Email->to($mail);
      $Email->subject($subject);
      $Email->send($msg);
      }
      }
      }
      } */

    public function EditProfile() {
        $this->checkUser();
        $this->layout = "company_layout";
        $id = $this->Session->read('User.id');
        if ($this->request->is('post')) {
            $data = $this->data;
            $data['User']['id'] = $id;
            unset($data['User']['email']);
            $i = 0;
            $validate = 0;


            if (!isset($data['User']['first_name']) || empty($data['User']['first_name'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('600', '0')));
                $validate++;
            } else if ($data['User']['password'] != $data['User']['confirm_password']) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('604', '0')));
                $validate++;
            } else if (!is_numeric($data['User']['zipcode'])) {
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('612', '0')));
                $validate++;
            }
            if (!empty($data['User']['password'])) {
                $data['User']['password'] = md5($data['User']['password']);
            }
            if ($data['User']['password'] == $data['User']['confirm_password'] && $data['User']['password'] == '') {
                unset($data['User']['password']);
            }
            unset($data['User']['confirm_password']);

            if ($data['User']['image']['error'] == 4) {
                unset($data['User']['image']);
            } else {
                $filename = WWW_ROOT . 'img' . DS . "" . time() . $data['User']['image']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if ($ext == 'gif' || $ext == 'png' || $ext == 'jpg') {
                    move_uploaded_file($data['User']['image']['tmp_name'], $filename);

                    $data['User']['pic_name'] = time() . $data['User']['image']['name'];
                    $this->Session->write('User.pic_name', $data['User']['pic_name']);
                } else {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('613', '0')));
                    $validate++;
                }
            }




            if ($validate == 0) {
                $this->User->save($data);
                $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('708', '1')));
            }
        }
        $res = $this->User->findById($id);
        $this->set('edit', $res['User']);
    }

    public function view() {
        $this->checkUser();
        $this->layout = "company_layout";
        if (isset($this->params->pass[0])) {
            $ide = base64_decode($this->params->pass[0]);


            $this->loadmodel('User');
            $res = $this->User->findById($ide);
            if (!empty($res['User']['country'])) {
                $country_id = $res['User']['country'];
                $country_name = $this->CountryMaster->findById($country_id);
                $res['User']['country'] = $country_name['CountryMaster']['country_name'];
            }

            $this->set('view', $res);
        } else {
            $this->redirect(array('controller' => 'Users', 'action' => index));
        }
    }

    /*
      public function EditOperator(){

      if(isset($this->params->pass[0])){

      $this->checkUser();
      $this->layout="company_layout";
      $this->loadmodel("User");
      if(isset($this->data['User'])){
      $data=$this->data;
      unset($data['User']['email']);
      $i=0;
      $validate=0;

      if( !isset($data['User']['first_name']) || empty($data['User']['first_name'])){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('600','0')));
      $validate++;
      }else if($data['User']['password'] != $data['User']['confirm_password'] ){
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('604','0')));
      $validate++;
      }else if (!is_numeric($data['User']['zipcode']) && !empty($data['User']['zipcode'])) {
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('612','0')));
      $validate++;
      }
      $data['User']['password']=md5($data['User']['password']);
      if($data['User']['password'] == $data['User']['confirm_password'] &&  $data['User']['password'] ==''){
      unset($data['User']['password']);
      }
      unset($data['User']['confirm_password']);

      if($data['User']['image']['error']==4){
      unset($data['User']['image']);
      }else{
      $filename = WWW_ROOT. 'img'.DS."".time().$data['User']['image']['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if( $ext == 'gif' || $ext == 'png' || $ext == 'jpg' ) {
      move_uploaded_file($data['User']['image']['tmp_name'],$filename);

      $data['User']['pic_name']=time().$data['User']['image']['name'];
      $this->Session->write('User.pic_name',$data['User']['pic_name']);
      }else{
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('613','0')));
      $validate++;
      }
      }
      if($validate==0){
      $this->User->save($data);
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('708','1')));
      }
      }
      $company_id = $this->Session->read('User.id');
      $ide=base64_decode($this->params->pass[0]);
      $res=$this->User->find('first',
      array(
      'conditions'=>
      array(
      'id'=>$ide,
      'company_id'=>$company_id
      )
      )
      );
      if(!empty($res)){
      $this->set('edit',$res['User']);
      }else{
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('625','0')));
      $this->redirect( $this->referer());
      }

      }else{
      $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
      array('pass'=>array('625','0')));
      $this->redirect( $this->referer());
      }
      } */

    public function EditOperator() {
        $this->autoRender = false;
        $db = array();
        $use = array();
        $ide = 0;

        if (isset($this->params->pass[0])) {

            $this->checkUser();
            $this->layout = "company_layout";
            $this->loadmodel("User");
            $company_id = $this->Session->read('User.id');
            $ide = base64_decode($this->params->pass[0]);



            $res = $this->User->find('first', array(
                'conditions' =>
                array(
                    'id' => $ide,
                    'company_id' => $company_id
                )
                    )
            );

            $dept_select = $this->DepartmentUser->find('all', array(
                'conditions' =>
                array(
                    'user_id' => $ide,
                    'company_id' => $company_id,
                    'status' => 1
                )
                    )
            );

            if ((!empty($dept_select)) && (!empty($res))) {

                $data['dept_select'] = $dept_select;
                $data['res'] = $res;

                echo json_encode($data);
                /// echo json_encode($dept_select);
                die;
            }
        }
        if ($this->request->is('post')) {
            $data = $this->data;
            $data['User'] = $data['Edit'];
            $this->User->save($data);

            $this->UserRole->id = $this->UserRole->field('id', array('user_id' => $data['User']['id']));
            if ($this->UserRole->id) {
                $this->UserRole->saveField('modify_date', time());
            }

            $len = count($data['selector']);
            if ($data['User']['password'] != $data['User']['confirm_password']) {
                echo "Password and Confirm password Does not match";
                die;
            }
            for ($a = 0; $a < $len; $a++) {
                $db['DepartmentUser']['user_id'] = $data['User']['id'];
                $res = $this->DepartmentUser->find('first', array('conditions' => array('user_id' => $db['DepartmentUser']['user_id'])));
                $res['DepartmentUser']['department_id'] = $data['selector'][$a];
                $this->DepartmentUser->save($res);
                unset($res['DepartmentUser']['department_id']);
            }
            echo "Records Updated Sucessfully";
        }
    }

    public function delete() {
        $this->autoRender = FALSE;
        if (isset($this->params->pass[0])) {
            $this->checkUser();
            $this->layout = "company_layout";
            $ide = base64_decode($this->params->pass[0]);
            $this->loadmodel('User');
            $company_id = $this->Session->read('User.id');
            /*$res = $this->User->find('first', array(
                'conditions' =>
                array(
                    'id' => $ide,
                    'company_id' => $company_id
                )
                    )
            );
            if (!empty($res)) {
                $data['User']['id'] = $ide;
                $data['User']['status'] = 4;
                $this->User->save($data);

                echo 1;
                die;
            }else{*/
                $resRole = $this->User->find('first', array(
                                                        'joins'=>array(
                                                                        array(
                                                                            'table'=>'user_roles',
                                                                            'alias'=>'UserRole',
                                                                            'type'=>'INNER',
                                                                            'conditions' => array('UserRole.user_id = User.id')
                                                                        )
                                                        ),
                                                        'conditions' =>
                                                                        array(
                                                                                'OR'=>array(
                                                                                    'User.id' => $ide,
                                                                                    'company_id' => $company_id
                                                                                ),
                                                                                'role_id' => 3
                                                                            ),
                                                       'fields' => 'UserRole.* , User.*',
                                                    )
                                            );
            
            
                if (!empty($resRole)) {
                    $this->UserRole->delete($resRole['UserRole']['id']);
                    echo 1;
                    exit;
                }
            //}
        }
    }

    public function ChangeStatus() {
        if (isset($this->params->pass[0])) {
            $this->checkUser();
            $ide = base64_decode($this->params->pass[0]);

            $this->loadmodel('User');
            $company_id = $this->Session->read('User.id');
            $res = $this->User->find('first', array(
                'conditions' =>
                array(
                    'id' => $ide,
                    'company_id' => $company_id
                )
                    )
            );
            if (!empty($res)) {
                $data = array();
                if ($res['User']['status'] == 1) {
                    $data['User']['status'] = 2;
                    $data['User']['id'] = $ide;
                    $this->User->save($data);
                    echo 1;
                    die;
                } else if ($res['User']['status'] == 2) {
                    $data['User']['status'] = 1;
                    $data['User']['id'] = $ide;
                    $this->User->save($data);
                    echo 2;
                    die;
                } else if ($res['User']['status'] == 3) {
                    $data['User']['status'] = 1;
                    $data['User']['id'] = $ide;
                    $this->User->save($data);
                    echo 2;
                    die;
                }
            }
        }
    }

    function ForgotPassword() {

        $this->autoRender = false;
        $msg = "";
        $mail = $this->data['mail'];
        $this->loadmodel("User");
        $res = $this->User->find('first', array('conditions' => array('User.email' => $mail)));
        if (!empty($res)) {
            $res['User']['email'] = $mail;
            $subject = " Your Password Recovery ";

            $link = HTTP_ROOT . 'Users/ChangePassword/' . base64_encode($res['User']['id']);
            $msg = "<div>Dear  " . $res['User']['first_name'] . " " . $res['User']['last_name'] . "<br>
        We have recieved a request to reset the password associated with the email address. If you made this request,
        please follow the instruction below. <br><br>
        If you didnot request to have your password reset, you can safely ignore this email. We assure that your customer account is safe.
        <br>
        <br><b><a href='" . $link . "'>Click here to Change Your Password.</br></a>
        <br>If clicking the doesnot work, you can copy and paste the link into browser's address window.<br>
        <br>Thanks <br><b>Dachat</b></div>";
            $mail = $res['User']['email'];
            $res['User']['forgot_link'] = $res['User']['id'];

            $Email = new CakeEmail('smtp');
            $Email->emailFormat('html');
            $Email->from(array('support@nextolive.com' => 'Dachat'));
            $Email->to($mail);
            $Email->subject($subject);

            $Email->send($msg);
            $this->User->save($res);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function EmailConfirmation($mail = null) {
        $this->layout = null;
        $mail = base64_decode($mail);
        $this->loadmodel('User');
        $res = $this->User->find('first', array(
            'conditions' =>
            array(
                'User.verification_link' => $mail,
                'User.status'=>3
            )
                )
        );
        if (!empty($res)) {
            $res['User']['status'] = 2;
            $res['User']['verification_link'] = '';
            $this->User->save($res);
        } else {
            $this->set('status', 'This link is Invalid If you are trying to this link does not access!!');
        }
    }

    public function ChangePassword($id = null) {
        $this->layout = null;
        $ide = base64_decode($id);
        $this->loadmodel('User');
        $user_id;
        $i = 0;
        $res = $this->User->find('first', array('conditions' => array('User.forgot_link' => $ide)));
        if (!empty($res)) {

            $user_id = $res['User']['forgot_link'];
            if ($this->request->is('post')) {

                $data = $this->data;

                if ((!empty($data['User']['password'])) && (!empty($data['User']['confirm_password']))) {

                    if (($data['User']['password']) == ($data['User']['confirm_password'])) {
                        $pass = $data['User']['password'];
                        $data['User']['id'] = $user_id;
                        $data['User']['forgot_link'] = '';
                        $data['User']['password'] = md5($pass);
                        //pr($data);die;
                    } else {
                        $this->requestAction(
                                array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('604', '0'))
                        );
                        $i++;
                    }
                } else {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('614', '0')));
                    $i++;
                    //pr($res);die;
                }

                if ($i == 0) {
                    $this->User->save($data);

                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('792', '1')));
                    $this->redirect(array('controller' => 'Users', 'action' => 'TestLink/M<jvtftedsxuhb'));
                }
            }
        } else {

            $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('625', '0')));
            $this->redirect(array('controller' => 'Users', 'action' => 'TestLink'));
        }
    }

    public function TestLink() {
        $this->layout = null;
        if (isset($this->params->pass[0])) {

            $ide = $this->params->pass[0];
            $this->loadmodel('User');
            $res = $this->User->find('first', array('conditions' => array('User.forgot_link' => $ide)));
            if (empty($res)) {
                $this->set('status', 'This link is Invalid. If you are trying this link does not access!!');
            }
        } else {
            $this->set('status', 'This link is Invalid. If you are trying this link does not access!!');
        }
    }

    function Plans() {
        $this->layout = "company_layout";
        $this->set('title_for_layout', COMPANY_PLANS);
        $this->loadmodel('SubscriptionPlan');
        $res = $this->SubscriptionPlan->find('all', array('conditions' => array('status' => 1)));
        $this->set('plan', $res);
    }

    function DeleteDepartment() {
        if (!empty($this->params->pass[0])) {
            $this->checkUser();
            $ide = base64_decode($this->params->pass[0]);
            $company_id = $this->Session->read('User.id');


            $res = $this->DepartmentMaster->find('first', array(
                'conditions' =>
                array(
                    'id' => $ide,
                    'company_id' => $company_id
                )
                    )
            );
            if (!empty($res)) {
                $res['DepartmentMaster']['status'] = 3;
                $this->DepartmentMaster->save($res);
                echo 1;
                die;
            }
        }
    }

    public function ChangeDepartmentStatus() {
        if (isset($this->params->pass[0])) {
            $this->checkUser();
            $ide = base64_decode($this->params->pass[0]);

            $company_id = $this->Session->read('User.id');
            $res = $this->DepartmentMaster->find('first', array(
                'conditions' =>
                array(
                    'id' => $ide,
                    'company_id' => $company_id
                )
                    )
            );
            if (!empty($res)) {
                $data = array();
                if ($res['DepartmentMaster']['status'] == 1) {
                    $data['DepartmentMaster']['status'] = 2;
                    $data['DepartmentMaster']['id'] = $ide;

                    $this->DepartmentMaster->save($data);
                    echo 1;
                    die;
                } else if ($res['DepartmentMaster']['status'] == 2) {
                    $data['DepartmentMaster']['status'] = 1;
                    $data['DepartmentMaster']['id'] = $ide;

                    $this->DepartmentMaster->save($data);
                    echo 2;
                    die;
                }

                $data['DepartmentMaster']['id'] = $ide;

                $this->DepartmentMaster->save($data);
            }
        }
    }

    function EditDepartment() {
        $this->checkUser();
        $this->layout = "company_layout";
        $this->set('title_for_layout', COMPANY_DEPART);
        $this->autoRender = false;
        if (isset($this->params->pass[0])) {

            $ide = base64_decode($this->params->pass[0]);
            $company_id = $this->Session->read('User.id');
            $res = $this->DepartmentMaster->find('first', array
                ('conditions' => array
                    ('DepartmentMaster.id' => $ide, 'DepartmentMaster.company_id' => $company_id
                )
                    )
            );
            if (!empty($res)) {
                echo json_encode($res);
                //echo json_encode($dept_select);
                die;
            }
        }
        if ($this->request->is('post')) {
            $data = $this->data;
            $data['DepartmentMaster'] = $data['EditDepartment'];
            // pr($data);die;
            if (!empty($data['DepartmentMaster']['department_name'])) {

                $result['DepartmentMaster']['id'] = $data['DepartmentMaster']['department_id'];
                $result['DepartmentMaster']['department_name'] = $data['DepartmentMaster']['department_name'];
                $this->DepartmentMaster->save($result);
                //$this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                // array('pass'=>array('796','1')));
                //$this->redirect(array('controller'=>'Users','action'=>'DepartList')); 
                echo "وزارت به روز رسانی با موفقیت";
                die;
            } else {
                // $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'), 
                //array('pass'=>array('635','0'))); 
                echo "لطفا نام گروه را پر کنید";
                die;
            }
        }
    }

    public function changeplanbilling() {
        $this->autoRender = false;
        if (!$this->Session->check('User')) {
            $this->redirect(array('controller' => 'Users', 'action' => 'login'));
        } else if ($this->Session->read('User.usertype') == 'operator') {
            $this->redirect(array('controller' => 'Operators', 'action' => 'index'));
        }

        $this->layout = "company_layout";
        if (isset($this->params->pass[0]) && isset($this->params->pass[1])) {
            $planid = convert_uudecode(base64_decode($this->params->pass[0]));
            $duration = convert_uudecode(base64_decode($this->params->pass[1]));
            $res = $this->SubscriptionPlan->find('first', array(
                'conditions' => array(
                    'id' => $planid,
                    'status' => array('1', '4')
                )
                    )
            );
            $resFeature = $this->PlanFeature->find('first', array(
                'conditions' => array(
                    'plan_id' => $planid
                )
                    )
            );
            //if ($this->request->is('post')) {
                //pr($this->request->data);die;
                if (!empty($res) && in_array($duration, array(1, 2, 3))) {
                    $company_id = $this->Session->check('User.id');
                    $subscipt = $this->SubscriptionMember->find('first', array(
                        'conditions' => array(
                            'user_id' => $company_id
                        ),
                        'order' => 'SubscriptionMember.id desc'
                            )
                    );
                    if (time() > isset($subscipt['SubscriptionMember']['end_date']) ? $subscipt['SubscriptionMember']['end_date'] : 123) {

                        // you are not subscribe to any plan
                        // debug($res);
                        $dataArray = array();
                        $subArray = array();
                        $dataArray['TransactionHistory']['txn_id'] = uniqid();
                        $dataArray['TransactionHistory']['user_master_id'] = $this->Session->read('User.id');
                        if ($duration == 2) {//biannual
                            $dataArray['TransactionHistory']['amount'] = $res['SubscriptionPlan']['plan_price'] * 6;
                            $dataArray['TransactionHistory']['discount'] = $res['SubscriptionPlan']['discount_biannual'];
                            $dataArray['TransactionHistory']['net_amount'] = ($res['SubscriptionPlan']['plan_price'] - $res['SubscriptionPlan']['plan_price'] * $res['SubscriptionPlan']['discount_biannual'] / 100) * 6;
                            $subArray['SubscriptionMember']['end_date'] = strtotime(date('Y-m-d', strtotime("+180 days")));
                        } else if ($duration == 3) {//annual
                            $dataArray['TransactionHistory']['amount'] = $res['SubscriptionPlan']['plan_price'] * 12;
                            $dataArray['TransactionHistory']['discount'] = $res['SubscriptionPlan']['discount_annual'];
                            $dataArray['TransactionHistory']['net_amount'] = ($res['SubscriptionPlan']['plan_price'] - $res['SubscriptionPlan']['plan_price'] * $res['SubscriptionPlan']['discount_annual'] / 100 ) * 12;
                            $subArray['SubscriptionMember']['end_date'] = strtotime(date('Y-m-d', strtotime("+365 days")));
                        } else {
                            $dataArray['TransactionHistory']['amount'] = $res['SubscriptionPlan']['plan_price'];
                            $dataArray['TransactionHistory']['discount'] = 0;
                            $dataArray['TransactionHistory']['net_amount'] = $res['SubscriptionPlan']['plan_price'];
                            $subArray['SubscriptionMember']['end_date'] = strtotime(date('Y-m-d', strtotime("+30 days")));
                        }
                        $dataArray['TransactionHistory']['add_date'] = date('Y-m-d H:i:s');
                        $dataArray['TransactionHistory']['modify_date'] = date('Y-m-d H:i:s');

                        $subArray['SubscriptionMember']['user_id'] = $this->Session->read('User.id');
                        $subArray['SubscriptionMember']['plan_id'] = $planid;
                        $subArray['SubscriptionMember']['start_date'] = time();
                        /* $subArray['SubscriptionMember']['is_free']=2; */
                        $subArray['SubscriptionMember']['txn_id'] = $dataArray['TransactionHistory']['txn_id'];
                        $subArray['SubscriptionMember']['status'] = 1;
                        $subArray['SubscriptionMember']['add_date'] = date('Y-m-d H:i:s');
                        $subArray['SubscriptionMember']['modify_date'] = date('Y-m-d H:i:s');
                        $datasource = $this->TransactionHistory->getDataSource();
                        try {
                            $datasource->begin();
                            if (!$this->TransactionHistory->save($dataArray)) {
                                throw new Exception();
                            } else if (!$this->SubscriptionMember->save($subArray)) {
                                throw new Exception();
                            }
                            $checkdeptt = $this->DepartmentMaster->find('count', array(
                                'conditions' => array(
                                    'company_id' => $company_id,
                                    'status' => 1
                                )
                                    )
                            );
                            if ($checkdeptt > $resFeature['PlanFeature']['department']) {
                                //deactivates exceeding department
                                $this->DepartmentMaster->query("update department_masters set status=2
                                where id not in (select * from (select id from department_masters where company_id = '" . $company_id . "' limit " . $resFeature['PlanFeature']['department'] . ") as t )
                                and company_id='" . $company_id . "'");
                            }
                            $checkagent = $this->User->find('count', array(
                                'conditions' => array(
                                    'company_id' => $company_id,
                                    'status' => 2
                                )
                                    )
                            );
                            if ($checkagent > $res['SubscriptionPlan']['operators']) {

                                $this->DepartmentMaster->query("update users set status=1
                                where id not in (select * from (select id from users where company_id = '" . $company_id . "' and status=2 limit " . $res['SubscriptionPlan']['operators'] . ") as t )
                                and company_id='" . $company_id . "' and status = 2");
                            }
                            $datasource->commit();
                            $this->Session->setflash('Your plan has been successfully changed.');
                            $this->redirect(array('controller' => 'Users', 'action' => 'Dashboard'));
                        } catch (Exception $e) {
                            $datasource->rollback();
                            $this->Session->setflash('Your Request cannot processed. Please try later.');
                        }
                    } else {
                        $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('642', '0')));
                    }
                } else {
                    $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('625', '0')));
                    $this->redirect($this->referer());
                }
           // }
        } else {
            $this->requestAction(array('controller' => 'Cpanels', 'action' => 'generateMessages'), array('pass' => array('625', '0')));
            $this->redirect($this->referer());
        }







        /*

          $true=0;
          $discount=0;
          $netamount=0;
          if($this->Session->check('Plan')){
          $plan=$this->Session->read('Plan');
          $subscribe_result=$this->SubscriptionMember->find('first',array('conditions'=>array('user_id'=>$this->Session->read('User.id'))));
          $result=$this->SubscriptionPlan->find('first',array('conditions'=>array('id'=>$plan['SubscriptionMember']['plan_id'])));
          if($this->request->is('post')){
          if(empty($subscribe_result)){
          $plan['SubscriptionMember']['add_date']=time();
          $plan['SubscriptionMember']['modify_date']=time();
          $plan['SubscriptionMember']['is_free']=1;
          $this->SubscriptionMember->save($plan);
          $this->Session->delete('Plan');
          $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
          array('pass'=>array('797','1')));
          $this->redirect(array('controller'=>'Users','action'=>'login'));
          }
          }
          if(isset($subscribe_result['SubscriptionMember']['is_free'])){
          if($subscribe_result['SubscriptionMember']['is_free']==1){
          $true=1;
          }
          }else{
          $true=0;
          }
          $this->set('subfree',$result['SubscriptionPlan']);
          $this->set('validate',$true);
          }else{
          $plan_id=$this->Session->read('PurchasePlan');
          if($this->request->is('post')){
          $dataArray=array();
          $subArray=array();
          $res=$this->SubscriptionPlan->find('first',array('conditions'=>array('id'=>$plan_id,'status'=>1)));
          if(!empty($res)){
          $amount=$res['SubscriptionPlan']['plan_price'];
          $binomial_discount=$res['SubscriptionPlan']['discount_biannual'];
          $annoul_discount=$res['SubscriptionPlan']['discount_annual'];
          $ab['SubscriptionMember']['end_date']=date('Y-m-d', strtotime("+1 year") );
          $discount=($amount*$annoul_discount)/100;
          $netamount=$amount-$discount;
          }

          $dataArray['TransactionHistory']['txn_id']=uniqid();
          $dataArray['TransactionHistory']['user_master_id']=$this->Session->read('User.id');
          $dataArray['TransactionHistory']['amount']=$amount;
          $dataArray['TransactionHistory']['discount']=$discount;
          $dataArray['TransactionHistory']['net_amount']=$netamount;
          $dataArray['TransactionHistory']['add_date']=date('Y-m-d H:i:s');
          $dataArray['TransactionHistory']['modify_date']=date('Y-m-d H:i:s');

          if($this->TransactionHistory->save($dataArray)){
          $subresult=$this->SubscriptionMember->find('first',
          array(
          'conditions'=>array(
          'user_id'=>$this->Session->read('User.id')
          ),
          'order' => array('id DESC')
          )
          );

          $ab['SubscriptionMember']['user_id']=$this->Session->read('User.id');
          $ab['SubscriptionMember']['start_date']=date('Y-m-d');
          $ab['SubscriptionMember']['plan_id']=$plan_id;
          $ab['SubscriptionMember']['is_free']=2;
          $ab['SubscriptionMember']['txn_id']=$dataArray['TransactionHistory']['txn_id'];
          $ab['SubscriptionMember']['status']=1;
          $ab['SubscriptionMember']['add_date']=date('Y-m-d H:i:s');
          $ab['SubscriptionMember']['modify_date']=date('Y-m-d H:i:s');

          $this->SubscriptionMember->save($ab);
          if(!empty($subresult)){
          $data1['SubscriptionMember']['id']=$subresult['SubscriptionMember']['id'];
          $data1['SubscriptionMember']['status']=2;
          $data1['SubscriptionMember']['user_id']=$this->Session->read('User.id');
          $this->SubscriptionMember->save($data1);
          }

          $this->Session->destroy();
          $this->requestAction(array('controller'=>'Cpanels', 'action'=>'generateMessages'),
          array('pass'=>array('798','1')));
          $this->redirect(array('controller'=>'Users','action'=>'login'));
          }
          }
          $true=1;
          $res=$this->SubscriptionPlan->findById($plan_id);
          if(!empty($res)){
          $this->set('subfree',$res['SubscriptionPlan']);
          $this->set('validate',$true);
          }
          } */
    }

    public function PlansBilling() {
        $this->layout = "company_layout";

        $res = $this->SubscriptionPlan->find('all', array('conditions' => array('status' => 1)));
        //pr($res);die;
        if ($this->request->is('post')) {
            $data = $this->data;
            $id = $data['SubscriptionPlan']['id'];

            $this->Session->write('PurchasePlan', $id);
            $this->Session->delete('Plan');
            $this->redirect(array('controller' => 'Users', 'action' => 'changeplanbilling'));
        }
        $this->set('view_plan', $res);
    }

}

?>