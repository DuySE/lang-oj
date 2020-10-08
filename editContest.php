<?php
	  // config all
	  include('control/configall.php');
	  include('gui/resource.php');

      // ACCESS CONTROL
      $_stt = true;
      /* place command & setting flag */
      include('control/requireContestID.php');
      /* end command */
      if (isset($_contestID) && !checkExistedContest($_contestID)) $_page_error = 1;
      include('control/permission.php');
      // END ACESS CONTROL
?>


<script> 
	

	quizid = parseInt("<?php echo getNextQuizID() ?>") + 1;
	mallid = parseInt("<?php echo getNextMallID() ?>") + 1;

	function addNewQuiz() {
		var quiz = document.createElement("div");
		quiz.setAttribute("id", "q" + quizid);
		quizidStr = "q" + quizid;

		var pat2 = "quest" + quizidStr;
		

		//alert(quizidStr);
		quiz.innerHTML = '<div> <input type = "hidden" value = "'+quizidStr+'" name = "listID[]"/>'
		+ '<input type = "hidden" value = "'+mallid+'" name = "questID'+ quizidStr+'"/>'
		+'<textarea rows="4" cols="50" id = "ta'+quizid+'" required name = "'+pat2+'"> This is eyecloud team.</textarea> <br>'
		+ '<table border="1" id = "'+quizid+'" > <tr> <th> Answer </th> <th> Is Solution </th><th> </th></tr>'	
		+	'</table></div>'
		+ 	'<input type="button" id="' + "ad"+quizid +'" value="+ New Answer" onclick = "addNewAns(\'' + quizid + '\'), follow()" >'
		+ 	'<input type="button" value="Hide" onclick = "hideAndShow(\'' + quizid + '\', this, \'' + "ad"+quizid + '\')" >'
		+ 	'<input type="button" value="Remove" onclick = "removeElement(\'' + quizidStr +'\')"> <hr>' +
		'<script>' + 
		'CKEDITOR.editorConfig = function( config )'+
		'{config.height = \'100px\';};' +
		'CKEDITOR.replace(\'ta'+quizid+'\');' + 
		'<\/script>';

		parent = document.getElementById("maincon");
		parent.appendChild(quiz);
			
		// add a node first
		mallid++;
		addNewAns(quizid);
		quizid++;
	}



	function addNewAns(parentID) {
		// get parent
		var par = document.getElementById(parentID);
		// provide new id
		var ansidStr = "an" + mallid;
		var quizidStr = "q" + parentID;
		var pat3 = "ans" + quizidStr + "[]";
		var pat4 = "chk" + quizidStr;
		// create row block
		var ans = document.createElement("tr");
		ans.setAttribute("id", ansidStr);
		ans.innerHTML = '<td> <input type="text" required name="'+pat3+'">' 
						+' <input type = "hidden" value = "'+mallid+'" name = "ansID'+ quizidStr+'[]"/> </td>'
						+'<td> <input type="radio" name="' + pat4 + '" value = "'+mallid+'"></td>'
						+'<td> <input type="button" onclick="removeAns(\''+parentID+'\',\''+ansidStr+'\')" value="Remove"> </td>';
		// add to parent a node
		par.appendChild(ans);
		// increase id
		mallid++;
	}

	// Remove an element by it's ID
	function removeElement( myquizid ) {
		e = document.getElementById(myquizid);
		e.parentNode.removeChild(e);
	}

	// Remove answer out of question
	function removeAns(parId, myansId) {
		var str = "#" + parId + " tr";
		var len =  $(str).length;
		if (len == 2) {
			alert("Question must have at least one Answer!");
			return;
		}
		removeElement(myansId);
	}

	// Hide / Show answer
	function hideAndShow(elementID, myButton, disButID) {
		var e = document.getElementById(elementID);
		var disBut = document.getElementById(disButID);
		var curState = e.style.display;
		if (curState == 'none') {
			e.style.display = 'block';
			myButton.setAttribute("value", "Hide");
			disBut.disabled = false;
		}
		else {
			e.style.display = 'none';
			myButton.setAttribute("value", "Show");
			disBut.disabled = true;
		}
	}

	// follow function
	function follow() {
		$(function() {
   			$('body').scrollTop($(window).scrollTop() + $(window).height());
		});
	}
</script>

<body class = "fonts1">
	
	<div id="body-wrapper">
   <?php include('gui/header.php') ?>
  <!-- BEGIN -->
   <div id="" class="section" style="background-color: #f0f0f0">
      <div class="container" >
      <!-- BEGIN BODY -->

    <div class="container" style="text-align: center;">
    <h1> Contest Editor </h1>
  	
  	<?php 
  		$_con = getContestById($_contestID);
  	?>
  	<font color="green"> <h2> <?php echo $_con['conName']?> </h2> </font>
  	<?php
			// LOCK THIS CONTEST
			if (getLockStateContest($_contestID) == true) {
      		?>
      			<img src="img/lock.png"> 
      			<script>
      				$(function(){
      					// prevent edit contest
      					$('input').prop("disabled", true);
   						$('textarea').prop("disabled", true);
      				});
      			</script>
      		<?php
      	}
	?>
	<br> <br>
  	<form action="editcomplete/" method="post" >
  		<div id = "maincon" >
  			<!-- All content of contest display here -->
			<?php

  				$_listQuiz = getListQuiz($_contestID);
  				// each quiz
  				foreach ($_listQuiz as $_quiz) {	
  					$_questID = getQuestID($_quiz);
  					
  				?>
  					<!-- Content place here -->
  					<div id = "q<?php echo $_quiz?>">
  						<div> 
  						<input type = "hidden" value = "q<?php echo $_quiz?>" name = "listID[]"/>
						<input type = "hidden" value = "<?php echo $_questID?>" name = "questIDq<?php echo $_quiz?>"/>
						<textarea rows="4" cols="50" required name = "questq<?php echo $_quiz?>"
						id = "ta<?php echo $_quiz?>"
						><?php echo getMallContent($_questID); ?></textarea> <br>
						<table border="1" id = "<?php echo $_quiz?>" style="text-align: center; width: 80%;">

						<script> 
						CKEDITOR.editorConfig = function( config )
						{
   								// misc options
   								config.height = '100px';
						};
						CKEDITOR.replace('ta<?php echo $_quiz?>'); 
						</script>

							<thead>
							<tr> 
								<th> Answer </th> 
								<th> Is Solution </th>
								<th> </th>
							</tr>
							</thead>
							<tbody>
							<?php 
								
								$_listAnsID = getListAnswer($_quiz);
								foreach ($_listAnsID as $_ansID) 
									if ($_ansID != $_questID) {
							?>
							<!-- All answer place here -->
							<tr id = "an<?php echo $_ansID?>">
								<td> 
									<input type="text" required name="ansq<?php echo $_quiz?>[]" 
									value="<?php echo getMallContent($_ansID); ?>" /> 
									<input type = "hidden" value = "<?php echo $_ansID?>" name = "ansIDq<?php echo $_quiz?>[]"/>
								</td>
								<td> 
									<input type="radio" name="chkq<?php echo $_quiz?>" value = "<?php echo $_ansID?>"
										<?php 
											if (isAnswer($_quiz, $_ansID)) {
										?>
											checked
										<?php 
											}  
										?>
									/>
								</td>
								<td> 
									<input type="button" onclick="removeAns('<?php echo $_quiz?>','an<?php echo $_ansID?>')" value="Remove"/> 
								</td>
							</tr>
							<?php 
								}
							?>
							</tbody>
						</table>
						</div>
					<input type="button" id="ad<?php echo $_quiz?>" value="+ New Answer" onclick = "addNewAns('<?php echo $_quiz?>'), follow()" />
					<input type="button" value="Hide" onclick = "hideAndShow('<?php echo $_quiz?>', this, 'ad<?php echo $_quiz?>')" />
					<input type="button" value="Remove" onclick = "removeElement('q<?php echo $_quiz?>')" /> 
					<hr>
  					</div>
  				<?php
  				}
  			?>
    	</div>
    	
    	<input type="button" value="+ Create New Question" onclick="addNewQuiz(), follow()" />
    	<br>
    	<input type="submit" value="Save change"  />

    	<input type="hidden" name="contestID" value="<?php echo $_contestID?>" />
    </form>
    </div>
    <!-- END BODY -->
    </div>
    </div>
    </div>
    <!-- END -->
    <?php 
    	include('gui/footer.php');
    ?>
</body>
</html>