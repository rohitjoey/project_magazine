<?php 
      $header="Comment";
      include 'inc/header.php';
      include 'inc/checklogin.php'; ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Comment<?php flashMessage(); ?></h3>
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
                    <h2>Comments</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table id="datatable" class="table table-hover table-bordered">
                         <thead>
                          <th>S.N</th>
                          <th>Commenter Name</th>  
                          <th>Email</th>
                          <th>Website</th>
                          <th>Message</th>
                          <th>Time</th>
                          <th>Type</th>
                          <th>Coment Id</th>
                          <th>Blog Id</th>
                          <th>Blog Name</th>
                          <th>Comment Status</th>
                          <th>Action</th>
                         </thead>
                          <tbody>
                            <?php
                              $comment=new Comment();
                              $data=$comment->getAllWaitingComment();
                              // debugger($data);
                              if ($data) {
                                foreach ($data as $key => $value) {
                            ?>        
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo $value->name;?></td>
                                      <td><?php echo $value->email;?></td>
                                      <td><?php echo $value->website;?></td>
                                      <td><?php echo html_entity_decode($value->message);?></td>
                                      <td><?php echo date('M d,Y h:i:s a',strtotime($value->created_date));?></td>
                                      <td><?php echo $value->commentType;?></td>
                                      <td><?php echo (isset($value->commentId) && !empty($value->commentId))?$value->commentId:"0";?></td>
                                      <td><?php echo $value->blogId;?></td>
                                      <td><?php echo $value->blogname;?></td>
                                      <td><?php echo $value->commentStatus;?></td>
                                      <td>
                                        <a href="process/comment?id=<?php echo($value->id);?> &amp; act=<?php echo substr(md5("Accept Comment".$value->id.$_SESSION['token']), 3, 10);?>" class="btn btn-success"   >
                                          <i class="fa fa-check"></i>
                                        </a>
                                        <a href="process/comment?id=<?php echo($value->id);?> &amp; act=<?php echo substr(md5("Reject Comment".$value->id.$_SESSION['token']), 3, 10); ?> " class="btn btn-danger" >
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


        