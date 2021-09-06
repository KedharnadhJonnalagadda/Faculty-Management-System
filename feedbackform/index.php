<?php
if (!isset($_SESSION)) {
  session_start();
}
require_once "../Dashbord/connect.php";
$Coursesql = "select SUB1,SUB2,SUB3,SUB4,SUB5,SUB6,LAB1,LAB2,LAB3,ELE1,ELE2,ELE3,ELE4,ELE5,ELE6,ELE7 from courses where BRANCH='CSE' AND YEAR>1 ORDER BY YEAR ASC,SEM ";
$CourseStmt = $conn->query($Coursesql);
$CourseStmt = $CourseStmt->fetchAll(PDO::FETCH_ASSOC);
$YSCoursesql = "select YEAR ,SEM from courses where BRANCH='CSE' AND YEAR>1 ORDER BY YEAR ASC,SEM ";
$YSCourseStmt = $conn->query($YSCoursesql);
$YSCourseStmt = $YSCourseStmt->fetchAll(PDO::FETCH_ASSOC);
$yscount = 0;

$ListSubjects = array();
foreach ($CourseStmt as $Crow) {

  foreach ($Crow as $CCrow) {
    if ($CCrow != "") {



      array_push($ListSubjects, $CCrow);
    }
  }
}
sort($ListSubjects);
//print_r($ListSubjects);


?>

<script>
 
  function has_not_grater() {
        var pattern = /["<]/;
        var password=document.getElementById("feedmessage").value ;
        
        if (password.match(pattern)) {
            document.getElementById("message").value = '';
            alert("😈Hey ,I'm also a hacker😈");
            return -10;
        }
        return 0;
    }
</script>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Feedback Form</title>
</head>

<body>


  <div class="content">

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">


          <div class="row justify-content-center">
            <div class="col-md-6">
              <h3 class="heading mb-4">Feedback Form</h3>
              <p><img src="images/undraw-contact.svg" alt="Image" class="img-fluid"></p>
            </div>
            <div class="col-md-6">

              <form class="mb-5" method="POST" id="contactForm" name="contactForm" action="feedbacksubmit.php">



                <div class="row">
                  <div class="col-md-12 form-group">
                    <label>Subject</label>
                    <select class="form-control" name="subject" required>
                      <option value="">Select</option>
                      <?php foreach ($ListSubjects as $CCrow) { ?>
                        <option value='<?php echo $CCrow; ?>'><?php echo $CCrow; ?></option>
                      <?php
                      } ?>
                    </select>
                  </div>
                </div>
                
                <div class="row">

                  <div class="col-md-12 form-group">
                    
                    <div class="rate">
                      
                      <input type="radio" id="star5" name="feedlevel" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="feedlevel" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="feedlevel" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="feedlevel" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="feedlevel" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <label>Discription</label>
                    <textarea class="form-control" onkeyup="has_not_grater();"  name="feedmessage" id="feedmessage" cols="30" rows="7" placeholder="Suggestions(if any)"></textarea>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <input type="submit"  value="SubmitFeedback" name="feed" class="btn btn-primary ">
                  </div>
                </div>
              </form>

              <div id="form-message-warning mt-4"></div>
              <div id="form-message-success">
                Your message was sent, thank you!
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>





</body>

</html>
<style>
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
  }

  .rate:not(:checked)>input {
    position: absolute;
    top: -9999px;
  }

  .rate:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
  }

  .rate:not(:checked)>label:before {
    content: '★ ';
  }

  .rate>input:checked~label {
    color: #ffc700;
  }

  .rate:not(:checked)>label:hover,
  .rate:not(:checked)>label:hover~label {
    color: #deb217;
  }

  .rate>input:checked+label:hover,
  .rate>input:checked+label:hover~label,
  .rate>input:checked~label:hover,
  .rate>input:checked~label:hover~label,
  .rate>label:hover~input:checked~label {
    color: #c59b08;
  }

  /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>