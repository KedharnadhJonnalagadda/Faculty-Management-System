<!DOCTYPE html>
<html>

<?php
session_start();
require_once "connect.php";


$sql = "select FID,FIRST_NAME FROM logins";

$stmt = $conn->query($sql);



?>

<body>

    <div id="feedback" class="page-wrapper">

        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-md-6 col-8 align-self-center">
                    <h3 class="page-title mb-0 p-0">Feedbacks</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Feedbacks</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <style>
            .modal.fade .modal-dialog.modal-dialog-zoom {
                -webkit-transform: translate(0, 0)scale(.5);
                transform: translate(0, 0)scale(.5);
            }

            .modal.show .modal-dialog.modal-dialog-zoom {
                -webkit-transform: translate(0, 0)scale(1);
                transform: translate(0, 0)scale(1);
            }

            tbody tr:hover {

                background-color: #F5F5F5;
                cursor: pointer;


            }
        </style>
        <style>
            body {
                background: #F5F5F5;
            }
        </style>
        <div class="container-fluid">

            <div class="row">
                <!-- column -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Feedbacks Table</h4>
                            <div class="table-responsive">
                                <table class="table user-table no-wrap">
                                    <thead>
                                        <tr>
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">FID</th>
                                            <th class="border-top-0">Name</th>
                                            <th class="border-top-0">Course Name</th>
                                            <th class="border-top-0">Average Feedback</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($stmt as $row) : ?>
                                            <?php
                                            $fid = $row['FID'];
                                            $selectsubject = "select SUBJECT FROM subjects where FID='$fid'";
                                            $stmtsubject = $conn->query($selectsubject);

                                            foreach ($stmtsubject as $subject) :
                                                $subject = $subject["SUBJECT"];


                                                $selectFeedback = "select avg(FEEDBACK_LEVEL),count(FEEDBACK_LEVEL) FROM feedback where SUBJECT='$subject'";

                                                $statFeedback = $conn->query($selectFeedback);
                                                $avgfeedback = $statFeedback->fetch();
                                                if ($avgfeedback['avg(FEEDBACK_LEVEL)'] >= 4)
                                                    $avgfeed = "Excellent";
                                                else if ($avgfeedback['avg(FEEDBACK_LEVEL)'] >= 3)
                                                    $avgfeed = "Good";
                                                else if ($avgfeedback['avg(FEEDBACK_LEVEL)'] >= 2)
                                                    $avgfeed = "Average";
                                                else if ($avgfeedback['avg(FEEDBACK_LEVEL)'] >= 1)
                                                    $avgfeed = "Poor";
                                                else if ($avgfeedback['avg(FEEDBACK_LEVEL)'] > 0)
                                                    $avgfeed = "Worst";
                                                else $avgfeed = "No Feedback";
                                                //echo $avgfeed;
                                                $selecttotalfeedback = "select FEEDBACK_LEVEL FROM feedback where SUBJECT='$subject'";
                                                $stattotalFeedback = $conn->query($selecttotalfeedback);
                                                $totalfeedback = $stattotalFeedback->fetchAll();
                                                //print_r( $totalfeedback);
                                                $totalfeedbacklevel = "[";
                                                foreach ($totalfeedback as $rowfeed) {
                                                    $totalfeedbacklevel .= $rowfeed['FEEDBACK_LEVEL'] . ',';
                                                }
                                                $totalfeedbacklevel .= "]";
                                                //echo $totalfeedbacklevel;
                                                $selectFeedback_dic = "select FEEDBACK_DISC FROM feedback where SUBJECT='$subject'";
                                                $stmtFeedback_dic = $conn->query($selectFeedback_dic)->fetchAll();
                                                $feedback = "";
                                                $fc = 1;
                                                foreach ($stmtFeedback_dic as $rowfeed) :
                                                    if (!empty($rowfeed['FEEDBACK_DISC'])) {
                                                        $feedback .= "$fc ." . $rowfeed['FEEDBACK_DISC'] . "<br/>";
                                                        $fc += 1;
                                                    }
                                                endforeach;

                                            ?>
                                                <tr id="subjectdic" data-id="<?php echo $row['FID'] ?>" data-subject="<?php echo $subject ?>" data-feedback="<?php echo $feedback; ?>" data-avgfeedchar="<?php echo $avgfeed; ?>" data-avgfeedback="<?php echo $avgfeedback['avg(FEEDBACK_LEVEL)']; ?>" data-countfeedback="<?php echo $avgfeedback['count(FEEDBACK_LEVEL)']; ?>" data-totalfeedback="<?php echo ($totalfeedbacklevel); ?>" data-toggle="modal" data-target="#exampleModal3">

                                                    <td><?php echo $count;
                                                        $count += 1; ?></td>
                                                    <td><?php echo $row['FID'] ?></td>
                                                    <td><?php echo $row['FIRST_NAME'] ?></td>
                                                    <td><?php echo $subject ?></td>
                                                    <td><?php echo $avgfeed ?></td>


                                                </tr>
                                        <?php endforeach;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                                <style>
                                    #discriptions {
                                        display: none;
                                    }



                                    .badge {
                                        font-size: 25px;
                                        font-weight: 200
                                    }

                                    .badge i {
                                        font-size: 20px;
                                        font-weight: 200
                                    }

                                    .about-rating {
                                        font-size: 15px;
                                        font-weight: 500;
                                        margin-top: 10px
                                    }

                                    .total-ratings {
                                        font-size: 12px
                                    }

                                    .bg-custom {
                                        background-color: #b7dd29 !important
                                    }

                                    .progress {
                                        margin-top: 10px
                                    }
                                    
                                </style>
                                <script>
                                    
                                </script>
                                <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-zoom modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Feedback Description</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6></h6>
                                                <hr />
                                                <div id="feedback_disc"></div>
                                            </div>
                                            <div class="modal-footer">

                                                <div class="col-md-3  " style="border-left: 2px solid;border-color:#b7dd29">
                                                    <div class="ratings text-center p-4 py-5"> <span class="badge bg-success" id="avgRating">4.1 <i class="fa fa-star-o"></i></span>
                                                        <span id="avgfeedchar" class="d-block about-rating">VERY GOOD</span>
                                                    </div>
                                                </div>
                                                <div class="col-md">
                                                    <div class="rating-progress-bars p-3">
                                                        <div class="progress-1 align-items-center">

                                                            <div class="progress">
                                                                <div class="progress-bar bg-success" id="f5" role="progressbar" style="width: 0%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"> </div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-custom" id="f4" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-primary" id="f3" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-warning" id="f2" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar bg-danger" id="f1" role="progressbar" style="width: 0%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="text" value='localhost/FMS/feedbackform/index.php' id="copyfeedlink" style="border:0px" />
                <button class="btn btn-outline-primary" onclick="copyToClipboard();" id="copyfeedlinkbtn" value="localhost/FMS/feedbackform/index.php">Get Feedback</button>
            </div>

        </div>

</body>

</html>