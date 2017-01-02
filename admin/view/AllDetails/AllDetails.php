        <div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<div id="wrapper">
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-lg-offset-1 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php  echo $collegeArray['0']['name'];?></div>
                                        <div>College</div>
                                    </div>
                                </div>
                            </div>
                            <a href='index.php?route=admin/collegelist&page=1'>
                                <div class="panel-footer">
                                    <span class="pull-left"> View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php  echo $courseArray['course_details'][0]['name'];?></div>
                                        <div>Course</div>
                                    </div>
                                </div>
                            </div>
                            <a href='index.php?route=admin/courselist'>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $subjectArray['subject_datails'][0]['countSubId'];?></div>
                                        <div>Subject</div>
                                    </div>
                                </div>
                            </div>
                            <a href='index.php?route=admin/subjectlist'>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                  
                    <div class="col-lg-2 col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $teacherArray['teacher_datails']['tid'];?></div>
                                        <div>Teacher</div>
                                    </div>
                                </div>
                            </div>
                            <a href='index.php?route=admin/teacherlist'>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                      
                     <div class="col-lg-2 col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $studentArray['studentall_datails']['stid'];?></div>
                                        <div>Student</div>
                                    </div>
                                </div>
                            </div>
                            <a href='index.php?route=admin/studentlist'>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <!-- /.row -->

               
                <!-- /.row -->

               
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
</div>
