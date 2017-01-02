<div class="header">
    <div class="jumbotron" style="background: #9acfea">
       
    kaushik
    </div>
</div> 
<div class="container">
<div class="row">
    <div class="col-md-6 col-md-offset-3 table-bordered ">
        <div class="col-md-5 col-md-offset-4 btn-lg">
            <span class="col-md-12 text-center">
               <?php	
                    if(empty($StudenDetailstArray['college_datails']['cname'])){
                        echo "not a data";
                    } else {
                ?>
		    <?php echo $StudenDetailstArray['college_datails']['cname']."<br>";?>
                    <?php echo $StudenDetailstArray['course_datils']['coursename'];?>
            </span>
        </div>
        <table  align="center" class="table-bordered table">
        <tr class="btn-lg">
            <th class="text-center">Student Id</th>
            <th class="text-center">Student Name</th>
            <th class="text-center">Age</th>
            <th class="text-center">Village</th>
            <th class="text-center">Phone No</th>
            </tr>
             <?php foreach($StudenDetailstArray['student_details']  as $k=>$v ):
            ?>
            <tr class="text-center">
            <td><?php echo $k+1;?></td>
            <td><?php echo $v['sname'];?></td>
            <td><?php echo $v['sage']; ?></td>
            <td><?php echo $v['svillage'];?></td>
            <td><?php echo $v['sphone_no'];?></td>
            </tr>
            <?php
                    endforeach;}
            ?>
    </table>
           </div>
    </div>
</div>

