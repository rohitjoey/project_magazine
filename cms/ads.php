<?php 
      $header="Ads";
      include 'inc/header.php';
      include 'inc/checklogin.php'; ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Ads<?php flashMessage(); ?></h3>
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
                    <h2>List of Ads</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:;" class="btn btn-primary"  onclick="showModal();">Add ad</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table id="datatable" class="table table-hover table-bordered">
                         <thead>
                          <th>S.N</th>
                          <th>URL</th>  
                          <th>adType</th>
                          <th>Image</th>
                          
                          
                         </thead>
                          <tbody>
                            <?php
                              $ads=new Ads();
                              $data=$ads->getAllAds();
                              // debugger($data,true);
                              if ($data) {
                                foreach ($data as $key => $ads) {
                                 
                                
                            ?>        
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo $ads->title;?></td>
                                      <td><?php echo html_entity_decode($ads->content);?></td>
                                      <td><?php echo $ads->featured;?></td>
                                      <td><?php echo $ads->ads;?></td>
                                      <td><?php echo (isset($ads->views) && !empty($ads->views))?$ads->views:"0";?></td>
                                      
                                      <?php 
                                        if(isset($ads->image) && !empty($ads->image) && file_exists(UPLOADS_PATH.'ads/'.$ads->image)){
                                          $thumbnail=UPLOAD_URL.'ads/'.$ads->image;
                                        }else{
                                          $thumbnail=UPLOAD_URL.'noimage.png';
                                        }
                                       ?> 
                                       <td><img src="<?php echo($thumbnail);?>" style="width: 250px; height: auto"></td>


                                      
                                      <td>
                                        <a href="addads?id=<?php echo($ads->id);?> &amp; act=<?php echo substr(md5("Edit Ads".$ads->id.$_SESSION['token']), 3, 10); ?> "  class="btn btn-info" >
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="process/ads?id=<?php echo($ads->id);?> &amp; act=<?php echo substr(md5("Delete Ads".$ads->id.$_SESSION['token']), 3, 10); ?> " class="btn btn-danger" onclick="return  confirm('Are you sure you want to delete this ads?')">
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
                    
                    <div class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title" id="title">Add ads</h4>
                            </div>
                            <form action="process/ads" method="post">
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Ad url</label>
                                <input type="url" class="form-control" placeholder="Enter the ad url" name="url" id="url">
                              </div>
                              <div class="form-group">
                                <label>Ad type</label><br>
                                <input type="radio" name="adtype" id="adtype" value="simplead" > Simple Ad
                                <input type="radio" name="adtype" id="adtype" value="widead" > Wide Ad
                              </div>
                              <div class="form-group" >
                                <label>Ad Image</label>
                                <input type="file" name="image" accept="image/*" id="image">
                              </div> 
                            
                            <div class="modal-footer">
                              <input type="hidden" id="id" name="id">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                          </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                      </div><!-- /.modal -->

                  </div>
                </div>
              </div>
            </div>
                     
        <!-- /page content -->

<?php include 'inc/footer.php';  ?>



<script src="assets/js/datatable.js"></script>
<script type="text/javascript">
  function  addAds(){
    $('#title').html('Add Ads');
    $('#adsname').val("");
    $('#id').removeAttr('value');

    showModal();
  }
  
  function  editAds(element){
    var ads_info=$(element).data('ads_info');
    if (typeof(ads_info) != 'object') {
      ads_info=JSON.parse(ads_info);
    }
     // console.log(ads_info);
    $('#title').html('Edit Ads');
    $('#adsname').val(ads_info.adsname);
    $('#id').val(ads_info.id);
    showModal();
  }


  function showModal(data=" "){
   
    $('.modal').modal();
  }

  
</script>
