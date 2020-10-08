<?php 
  ob_start();
  include("control/configall.php");
  include('gui/resource.php'); 
      $_stt = true;

      // IF EDIT BLOG REQUIRED
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            if (isset($_POST['conID'])) {
                $_contestID = $_POST['conID'];
              
                if (checkExistContest($_contestID)) {
                      // new content
                      if (isset($_POST['blog'])) {
                          // get blog content
                          $_con_blog = $_POST['blog'];
                          // update blog content
                          updateBlog($_contestID, $_con_blog);
                          // change back to forum
                          $_new_page = 'blog/'.$_contestID;
                          header("Location: $_new_page");
                          // set session => announcement: successful!
                          exit(0);
                        }
                      else
                        $_page_error = 1;
                }
                else
                  $_page_error = 1;
            }
            else
                $_page_error = 1;
      }
      
      /* place command & setting flag */
      include('control/requireContestID.php');
      if (!isset($_SESSION['admin'])) $_need_admin = 1;
      /* end command */
      include('control/permission.php');

      // Get contest
      $_contestID = $_GET['id'];
      $_con = getContestByID($_contestID);
?>

<body class="fonts1">
   
   <div id="body-wrapper">
   <?php include('gui/header.php') ?>
   <script>
      var d = document.getElementById("navcon");
   </script>
   <!-- BEGIN -->
   <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
        <div class="text-content hasFontScale" data-fontscale="0.6561">
        <!-- BEGIN BODY -->
          
          <h1>
            <span class="fontSize" style="font-size: 24px; line-height: 1">
              <span>
                <span style="color:#696969">Edit Blog</span> <br>
                <span style="color:#696969"> <?php echo $_con['conName'] ?></span> <br>
              </span>
            </span>
          </h1>
          <form method="post">
            <textarea name="blog" id="ten" required><?php echo $_con['blog'] ?></textarea><br>
            <button type="submit" class="btn btn-success">Edit</button>&nbsp;
            <input type="hidden" name = "conID" value="<?php echo $_con['conID']?>">
          </form>
        <!-- END BODY -->
         
         </div>
      </div>
   </div>
   <!-- HORIZONTLE -->
   <?php include('gui/footer.php') ?>
   <script>CKEDITOR.replace('ten');</script>
</body>
</html>
<?php ob_flush() ?>