<?php 
      $header="Blog";
      include 'inc/header.php';
      include 'inc/checklogin.php'; ?>
        
     <?php 
     $page='Add';
        
        if ($_GET) {
          if (isset($_GET['id']) && !empty($_GET['id'])) {
            $blog_id = (int)$_GET['id'];
            if ($blog_id) {
              $act= substr(md5("Edit Blog".$blog_id.$_SESSION['token']), 3,10);
              if ($act==$_GET['act']) {
                $blog = new Blog();
                $blog_info = $blog->getBlogbyId($blog_id);
                if ($blog_info) {
                  // debugger($blog_info,true);
                  $blog_info = $blog_info[0];
                  $page = "Edit";
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
                    <h2><?php echo $page;?> Blogs</h2>
                    <!-- <ul class="nav navbar-right panel_toolbox">
                      <a href="JavaScript:;" class="btn btn-primary" onclick="addBlog();">Add blog</a>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- Contents -->
                    <form action="process/blog" method="post" enctype="multipart/form-data">
                      <div class="form-group col-md-8" >
                        <label>Blog Title</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Blog Title" value="<?php echo (isset($blog_info->title) && !empty($blog_info->title))?$blog_info->title:"";?>">
                      </div>  
                      <div class="form-group col-md-8" >
                        <label>Blog Content</label>
                        <textarea name="content" id="content" cols="30" rows="10" placeholder="Contents here" class="form-control">
                         <?php echo (isset($blog_info->content) && !empty($blog_info->content))?$blog_info->content:"";?>
                        </textarea>
                      </div>  
                      <div class="form-group col-md-8" >
                        <label>Featured?</label><br>
                        <input type="radio" name="featured" id="featured" value="Featured" <?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured=='Featured')?"Checked":"" ?>>Featured <br>
                        <input type="radio" name="featured" id="featured" value="Not featured" <?php echo (isset($blog_info->featured) && !empty($blog_info->featured) && $blog_info->featured!='Featured')?"Checked":"" ?>>Not Featured
                        

                      </div>  
                      <div class="form-group col-md-8" >
                        <label>Category</label>
                        <select name="categoryid" id="categoryid" class="form-control">
                          <option value="" selected="selected" disabled="disabled">--Select Category--</option>
                          <?php  
                            $category= new Category();
                            $categories=$category->getAllCategory();
                            if($categories){
                              foreach ($categories as $key => $category) {
                          ?>
                            <option value="<?php echo($category->id); ?>" <?php echo ($blog_info->categoryid==$category->id)?'selected':"";?>><?php echo($category->categoryname);?></option>
                          <?php   
                            }
                          }
                          ?>
                        </select>
                      </div>  
                      <div class="form-group col-md-8" >
                        <label>Blog Image</label>
                        <input type="file" name="image" accept="image/*" id="image">
                      </div> 
                      <?php 
                        if(isset($blog_info->image) && !empty($blog_info->image) && file_exists(UPLOADS_PATH.'blog/'.$blog_info->image)){
                          $thumbnail=UPLOAD_URL.'blog/'.$blog_info->image;
                        }else{
                          $thumbnail=UPLOAD_URL.'noimage.png';
                        }
                       ?>  
                      <div class="form-group col-md-8" >
                        <img src="<?php echo($thumbnail); ?>" id="preview" style="width: 250px ;height: auto;">                        
                      </div>  
                      <div class="form-group col-md-8" >
                        <input type="hidden" name="old_image" id="old_image" value="<?php echo (isset($blog_info->image) && !empty($blog_info->image))?$blog_info->image:"" ;?>">
                        <input type="hidden" name="id" id="id" value="<?php echo (isset($blog_info->id) && !empty($blog_info->id))?$blog_info->id:"" ;?>">
                       <button type="submit" class="btn btn-success">Submit</button>
                      </div>  
                    </form>
                  </div>
                </div>
              </div>
            </div>
     
                   

                     
        <!-- /page content -->

<?php include 'inc/footer.php';  ?>
<script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js" id=""></script>
<script src="assets/js/datatable.js"></script>
<script type="text/javascript">
  
   
    ckeditor($('#content').val());
  


  function  ckeditor(data=""){
    $('.ck').remove();
    ClassicEditor
      .create( document.querySelector( '#content' ) )
      .then( editor => {
          editor.setData(data);
      } )
      .catch( error => {
          console.error( error );
      } );
  }

  document.getElementById("image").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};
</script>

        