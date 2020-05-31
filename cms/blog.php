<?php 
      $header="Blog";
      include 'inc/header.php';
      include 'inc/checklogin.php'; ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Blog<?php flashMessage(); ?></h3>
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
                    <h2>Blogs</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="addblog" class="btn btn-primary">Add blog</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table id="datatable" class="table table-hover table-bordered">
                         <thead>
                          <th>S.N</th>
                          <th>Blog Title</th>  
                          <th>Content</th>
                          <th>Featured</th>
                          <th>Category</th>
                          <th>Views</th>
                          <th>Image</th>
                          <th>Action</th>
                          
                         </thead>
                          <tbody>
                            <?php
                              $blog=new Blog();
                              $data=$blog->getAllBlog();
                              // debugger($data,true);
                              if ($data) {
                                foreach ($data as $key => $blog) {
                                 
                                
                            ?>        
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo $blog->title;?></td>
                                      <td><?php echo html_entity_decode($blog->content);?></td>
                                      <td><?php echo $blog->featured;?></td>
                                      <td><?php echo $blog->category;?></td>
                                      <td><?php echo (isset($blog->views) && !empty($blog->views))?$blog->views:"0";?></td>
                                      
                                      <?php 
                                        if(isset($blog->image) && !empty($blog->image) && file_exists(UPLOADS_PATH.'blog/'.$blog->image)){
                                          $thumbnail=UPLOAD_URL.'blog/'.$blog->image;
                                        }else{
                                          $thumbnail=UPLOAD_URL.'noimage.png';
                                        }
                                       ?> 
                                       <td><img src="<?php echo($thumbnail);?>" style="width: 250px; height: auto"></td>


                                      
                                      <td>
                                        <a href="addblog?id=<?php echo($blog->id);?> &amp; act=<?php echo substr(md5("Edit Blog".$blog->id.$_SESSION['token']), 3, 10); ?> "  class="btn btn-info" >
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="process/blog?id=<?php echo($blog->id);?> &amp; act=<?php echo substr(md5("Delete Blog".$blog->id.$_SESSION['token']), 3, 10); ?> " class="btn btn-danger" onclick="return  confirm('Are you sure you want to delete this blog?')">
                                          <i class="fa fa-trash"></i>
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
