<?php 
      $header="Archive";
      include 'inc/header.php';
      include 'inc/checklogin.php'; ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Archive<?php flashMessage(); ?></h3>
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
                    <h2>List of Archive</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <a href="JavaScript:;" class="btn btn-primary" onclick="addArchive();">Add archive</a>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                       <table id="datatable" class="table table-hover table-bordered">
                         <thead>
                          <th>S.N</th>
                          <th>Archive Date</th>  
                          <th>No of blogs in this Date</th>
                          <th>Action</th>
                         </thead>
                          <tbody>
                            <?php
                              $archive=new Archive();
                              $data=$archive->getAllArchive();
                                $number=$archive->getArchiveNumberByDate();
                              if ($data) {
                                foreach ($data as $key => $value) {
                                 
                                
                            ?>        
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo date("M d,Y",strtotime($value->date));?></td>
                                      
                                      <td><?php echo $number[$key]->count; ?></td>
                                      <td>
                                        <a href="javascript:;" class="btn btn-info" onclick="editArchive(this);" data-archive_info='<?php echo(json_encode($value)); ?>' >
                                          <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="process/archive?id=<?php echo($value->id);?> &amp; act=<?php echo substr(md5("Delete Archive".$value->id.$_SESSION['token']), 3, 10); ?> " class="btn btn-danger" onclick="return  confirm('Are you sure you want to delete this blog?')">
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
                              <h4 class="modal-title" id="title">Add Archive</h4>
                            </div>
                            <form action="process/archive" method="post">
                            <div class="modal-body">
                              <div class="form-group">
                                <label>Archive Date</label>
                                <input type="date" class="form-control" placeholder="Archive Date" name="date" id="date">
                              </div>
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
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js" id=""></script>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">
  function  addArchive(){
    $('#title').html('Add Archive');
    $('#date').val("");
    $('#id').removeAttr('value');

    showModal();
  }
  
  function  editArchive(element){
    var archive_info=$(element).data('archive_info');
    if (typeof(archive_info) != 'object') {
      archive_info=JSON.parse(archive_info);
    }
     // console.log(archive_info);
    $('#title').html('Edit Archive');
    $('#date').val(archive_info.date);
    $('#id').val(archive_info.id);
    showModal();
  }


  function showModal() {
    $('.modal').modal();
  }

  
</script>

        