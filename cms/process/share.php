<?php
include $_SERVER['DOCUMENT_ROOT'] . '/config/init.php';
$Share = new Share();
// debugger($_POST,true);
if (isset($_POST) && !empty($_POST)) {
    $data = array(
        'icon_name' => sanitize($_POST['icon_name']),
		'url' => filter_var($_POST['url'],FILTER_SANITIZE_URL),
		'class' => sanitize($_POST['class']),
        'status' => 'Active',
        'added_by' => $_SESSION['user_id'],
    );
    // debugger($data);
    if(isset($_POST['id']) && !empty($_POST['id'])){
            // update
            $action='Updat';
            $share_id=(int)$_POST['id'];
    }else{
            // add
            $action='Add';
            $share_id=false;

        }

        if($share_id){
            $share_info=$Share->getShareById($share_id);
            if($share_info){
                if($_SESSION['user_id'] == $share_info[0]->added_by){
                    $success=$Share->updateShareById($data,$share_id);
                }else{
                    redirect('../share','error','You are not allowed');

                }
            }else{
                redirect('../share','error','Share not found');

            }
        }else{
            $success=$Share->addShare($data);

        }
    
    if ($success) {
        redirect('../share', 'success', $action . 'ed share succesfully');
    } else {
        redirect('../share', 'error', 'Problem while ' . $action . 'ing share.');
    }
// for deletion
}else if (isset($_GET) && !empty($_GET)) {
// debugger($_GET,true);
    $share_id = (int)$_GET['id'];
    debugger($_GET);
    if($_GET['act'] == substr(md5("Delete-Share Icons-".$share_id.$_SESSION['token']),5,15)){
        $data = array(
            'status'=> 'Passive'
        );
        $success = $Share->updateShareById($data,$share_id);
        if($success){
            redirect('../share','success','Share has been deleted successfully.');
        }
        else{
            redirect('../share','error','Problem while deleting the share');
        }
    }
    else{
        redirect('../share','error','Deletion is not allowed to this user.');
    }
} else {
    redirect('../share', 'error', 'Access denied.');
}
?>