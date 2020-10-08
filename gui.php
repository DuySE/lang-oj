<?php 
  ob_start();
  include("control/configall.php");
  include('gui/resource.php'); 
?>

<style>
    .main_post {
        margin: 20px 20px 20px 50px;
        padding-top: 20px;

    }
</style>
<meta charset="utf-8">
<body class="fonts1" style="min-height: 1000px;">
   <div id="body-wrapper">
   <?php include('gui/header.php') ?>
  
   <!-- BEGIN -->
   <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
      <br>
        
      
         <div class = "" style="background-color: white; border-radius: 10px; box-shadow: 0px 2px 15px 0px rgba(0,0,0,0.5);">
           
              <!-- content of blog -->
              <div class="main_post" style="word-wrap: break-word;background-color: white;">
                <div style="margin-left: 15px; border-radius: 25px;">
                <p><img alt="" width="810px" src="img/cover_0.png"/></p>
                </div>

<p><h3> <strong>Giới thiệu về Language Online Judge</strong></h3></p>
<div style="text-align: center">
<p ><img alt="" src="img/demo/home.PNG" /></p>
</div>

<p>Bạn đang muốn học tốt tiếng anh ?&nbsp;</p>

<p>Bạn cần t&igrave;m kiếm một nơi để luyện tập thường xuy&ecirc;n ?&nbsp;</p>

<p>Bạn t&igrave;m kiếm một cộng đồng c&ugrave;ng nhau chia sẽ kiến thức để học ng&ocirc;n ngữ hiệu quả ?</p>

<p>H&atilde;y đến với<strong> LangOJ</strong>, bạn sẽ được<strong>&nbsp;</strong>tham gia c&aacute;c cuộc thi&nbsp;trực tuyến c&oacute; t&iacute;nh điểm, thời gian v&agrave; xếp hạng.&nbsp;C&aacute;c cuộc thi sẽ được chia theo c&aacute;c chủ đề v&agrave; k&egrave;m theo t&agrave;i liệu. C&ugrave;ng trau dồi kiến thức với&nbsp;cộng đồng học ng&ocirc;n ngữ của ch&uacute;ng t&ocirc;i.</p>

<br>
<p><h3><strong>Tạo mới t&agrave;i khoản</strong></h3></p>

<p>Để bắt đầu trước ti&ecirc;n h&atilde;y tạo một t&agrave;i khoản. Bạn nhấn v&agrave;o <strong>"Register"</strong> ở g&oacute;c phải trang để đăng k&yacute;.</p>

<p><em>Lưu ý:</em></p>

<p>&#9679; <em>username</em> : độ d&agrave;i&nbsp;từ 4&nbsp;- 12 k&yacute; tự, kh&ocirc;ng c&oacute; khoảng trắng v&agrave; k&yacute; tự đặc biệt, chưa tồn tại.</p>

<p>&#9679; <em>password</em> : độ d&agrave;i từ 6 - 20 k&yacute; tự, kh&ocirc;ng c&oacute; khoảng trắng.</p>

<p>Đổi mật khẩu ở trang <strong>&quot;profile&quot;</strong>.</p>

<p style="text-align: center"><img alt="" src="img/demo/profile.PNG" style="height:350px; width:547px" /></p>
<br>
<p><h3> <strong>Tham gia cuộc thi </strong> </h3></p>

<p>Bạn phải đăng nhập&nbsp;để c&oacute; thể thấy được cuộc thi (contest).</p>

<p>Xem tất cả c&aacute;c cuộc thi ở link:&nbsp;<a href="contests"><font color="blue">contests</font></a></p>

<p>Kh&ocirc;ng cần đăng k&yacute; để tham gia một contest, khi contest bắt đầu chọn <strong>Enter</strong> ở cột <strong>Action</strong> để tham gia.</p>

<p style="text-align: center"><img style="text-align: center"alt="" src="img/demo/contest_running.PNG" /></p>

<p>Ho&agrave;n th&agrave;nh c&aacute;c Task trong contest. Sau đ&oacute; bạn c&oacute; thể sử dụng c&aacute;c thao t&aacute;c sau:</p>

<p><strong>&#9679; Save</strong>: lưu b&agrave;i hiện tại.</p>

<p><strong>&#9679; Submit</strong>: nộp b&agrave;i, kết th&uacute;c contest.</p>

<p>Nếu đang ở trang l&agrave;m b&agrave;i th&igrave; khi contest kết th&uacute;c,&nbsp;b&agrave;i l&agrave;m sẽ được nộp tự động&nbsp;(kh&ocirc;ng khuyến kh&iacute;ch). Cần chờ đợi v&agrave;i ph&uacute;t sau khi contest kết th&uacute;c để xem được kết quả.</p>
<br>
<p><h3><strong>Chấm điểm:</strong></h3></p>

<p>Điểm tối đa một contest l&agrave; 100 điểm. Mỗi c&acirc;u hỏi c&oacute; điểm tương đương nhau. Số điểm sẽ l&agrave; % số c&acirc;u bạn trả lời đ&uacute;ng tr&ecirc;n&nbsp;tổng số c&acirc;u.</p>

<p><em>V&iacute; dụ:</em> contest c&oacute; 10 c&acirc;u hỏi, bạn trả lời đ&uacute;ng 7 c&acirc;u, điểm sẽ l&agrave; 7 / 10 * 100 = 70 điểm.</p>

<p><strong> <em>Mỗi c&acirc;u hỏi sẽ c&oacute; 3 trạng th&aacute;i chấm:</em></strong></p>

<p><em><font color="green"><strong>&#9679; Correct: </strong></font></em>c&acirc;u trả lời đ&uacute;ng được to&agrave;n bộ điểm c&acirc;u đ&oacute;.</p>

<p><em><font color="red"><strong>&#9679; In-correct:</strong></font></em> c&acirc;u trả lời sai, kh&ocirc;ng được điểm.</p>

<p><em><font color="orange"><strong>&#9679; Not answer:</strong></font></em> kh&ocirc;ng trả lời, kh&ocirc;ng được điểm.</p>

<p style="text-align: center"><img alt="" src="img/demo/judge.PNG" /></p>

<p>Sau khi hệ thống chấm bạn c&oacute; thể v&agrave;o lại trang bạn đ&atilde; l&agrave;m b&agrave;i để xem được b&agrave;i l&agrave;m của m&igrave;nh.</p>

<br>
<p><h3><strong>Giải thưởng</strong></h3></p>

<p><strong>&#9679; Hạng 1:</strong> C&uacute;p v&agrave;ng - Gold trophy <img src="img/prize/gold.png" width="25" height="25"> </p>

<p><strong>&#9679; Hạng 2:</strong> C&uacute;p bạc - Silver trophy <img src="img/prize/silver.png" width="25" height="25"></p>

<p><strong>&#9679; Hạng 3:</strong> C&uacute;p đồng - Bronze trophy <img src="img/prize/bronze.png" width="25" height="25"></p>

<p><strong>&#9679; Hạng 4 - 10:</strong> Huy chương top 10 <img src="img/prize/top10.png" width="25" height="25"></p>

<p style="text-align: center"><img alt="" src="img/demo/contest_end.PNG" style="height:385; width:539px" /></p>

<br>
<p><h3><strong>Xếp hạng</strong></h3></p>

<p><em><strong>1. Xếp hạng trong contest</strong></em></p>

<p>Sau khi contest kết th&uacute;c, bạn c&oacute; thể xem trong &quot;final standing&quot;.</p>

<p style="text-align: center;"><img alt="" src="img/demo/ranking.PNG" style="height:194px; width:728px" /></p>

<p><em><strong>2. Bảng xếp hạng tổng</strong></em></p>

<p>Xem tổng xếp hạng ở trang &quot;rating&quot;: <a href="rating"><font color="blue">rating</font></a>&nbsp;</p>

<p style="text-align: center;"><img alt="" src="img/demo/rating.PNG" /></p>

<p><em><strong>3. Level account</strong></em></p>

<p>Tương ứng với số điểm, username bạn sẽ c&oacute; m&agrave;u để ph&acirc;n biệt cấp độ. Cụ thể như bảng sau:</p>
<p style="text-align: center;"><img alt="" src="img/demo/color_rating.PNG" style="height:235px; width:256px" /></p>

<br>
<p><h3><strong>Hệ thống t&iacute;nh điểm&nbsp;</strong></h3></p>

<p>Khi tham gia một contest, dựa v&agrave;o kết quả tổng điểm của bạn sẽ thay đổi.&nbsp;</p>

  <p>&#9679;&nbsp; A = số lượng người rating cao hơn c&oacute; thứ hạng thấp hơn</p>
  <p>&#9679;&nbsp; B = số lượng người rating thấp hơn nhưng c&oacute; thứ hạng cao hơn</p>
  <p>&#9679;&nbsp; Bonus = t&ugrave;y theo achivement (gold trophy: 50 điểm; silver trophy: 20 điểm; bronze trophy: 10 điểm; top10: 5 điểm)</p>


<p><strong>Điểm gia tăng</strong> = A - B + Bonus</p>

<br>
<p><h3><strong>Luyện tập&nbsp;</strong></h3></p>

<p>Sau khi kỳ thi kết th&uacute;c hệ thống sẽ tự động chuyển contest sang chế độ luyện tập.</p>

<p>Link:&nbsp;<a href="practices"><font color="blue">practices</font></a></p>

<p>Bạn c&oacute; thể l&agrave;m bao nhi&ecirc;u lần t&ugrave;y &yacute;, kết quả sẽ kh&ocirc;ng được t&iacute;nh.</p>

<p>Chọn contest v&agrave; nhấn n&uacute;t <strong>&quot;Go&quot;</strong>. Nhấn v&agrave;o n&uacute;t <strong>&quot;Check your answer&quot;</strong> để kiểm tra đ&aacute;p &aacute;n sau khi ho&agrave;n th&agrave;nh.</p>

<br>
<p><h3><strong>Thảo luận</strong></h3></p>

<p>Nhấn v&agrave;o t&ecirc;n contest để đến phần th&ocirc;ng b&aacute;o v&agrave; thảo luận.&nbsp;Ch&uacute; &yacute; kh&ocirc;ng trao đổi về đề b&agrave;i trong l&uacute;c diễn ra contest.</p>

<p>&nbsp;</p>
<p><strong>LangOJ Team</strong></p> <br>

              </div>

              <!-- END CONTENT -->
      </div>
   </div>
   <!-- HORIZONTLE -->

</body>
<footer>
<?php 
      include('gui/footer.php');
?>
</footer>

</html>
<?php ob_flush() ?>