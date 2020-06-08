<?php 
 $header="Subscribe";
      include 'inc/header.php';
      include 'inc/checklogin.php';
if ($_GET) {
          if (isset($_GET['id']) && !empty($_GET['id'])) {
            $subscribe_id = (int)$_GET['id'];
            if ($subscribe_id) {
              $act= substr(md5("Delete Subscribe".$subscribe_id.$_SESSION['token']), 3, 10);
              if ($act==$_GET['act']) {
                $subsribe = new Subscribe();
                $subscribe_info = $subsribe->getSubscribeById($subscribe_id);
                if ($subscribe_info) {
                  $data=array(
                              'status'=>'Passive');
                   $success=$subsribe->updateSubscribeById($data,$subscribe_id);
                   if($success){
                    redirect('subscribe','success','Deleted successfully');
                   }
                  
                }
              }
            }
          }
        }

      ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Subscribe<?php flashMessage(); ?></h3>
              </div>

             <!--  <div class="title_right">
               <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                 <div class="input-group">
                   <input type="text" class="form-control" placeholder="Search for...">
                   <span class="input-group-btn">
                     <button class="btn btn-default" type="button">Go!</button>
                   </span>
                 </div>
               </div>
             </div>
                         </div> -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Subscribes</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table id="datatable" class="table table-hover table-bordered">
                         <thead>
                          <th>S.N</th>
                          <th>Email</th>
                          <th>Date and Time Subsribed</th>
                          <th>Delete Subsriber?</th>
                         </thead>
                          <tbody>
                            <?php
                              $subscribe=new Subscribe();
                              $data=$subscribe->getAllSubscribe();
                              // debugger($data);
                              if ($data) {
                                foreach ($data as $key => $value) {
                            ?>        
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo $value->email;?></td>
                                      <td><?php echo date('M d,Y h:i:s a',strtotime($value->created_date));?></td>
                                      <td>
                                        
                                        <a href="subscribe?id=<?php echo($value->id);?> &amp; act=<?php echo substr(md5("Delete Subscribe".$value->id.$_SESSION['token']), 3, 10); ?> " class="btn btn-danger" onclick="return  confirm('Are you sure you want to delete this ads?')" >
                                          <i class="fa fa-close"></i>
                                        </a>
                                                                                    
                                      </td> 

                                    </tr>
                            
                            <?php
                                }
                              }
                            ?>
                          </tbody>

                       </table>   
                    
                    


                  </div>
                </div>
              </div>
            </div>
                     
        <!-- /page content -->

<?php include 'inc/footer.php';  ?>
<script src="assets/js/datatable.js"></script>


        