<?
foreach ($datareport as $row) {
header("Content-type: application/octet-stream"); 
header("Content-Disposition: attachment; filename=".$row->branchname."(".$row->schdate.").xls"); 
header("Pragma: no-cache"); 
header("Expires: 0");
}
?>
<div class="wrapper col5">
    <div id="container">
        <div>
            <table border="1">
                <thead>
                    <tr bgcolor="#CCCCCC">
                        <th>No.</th>
                        <th>Date of register</th>
                        <th>Venue of test</th>
                        <th>Date of Test</th>
                        <th>Module</th>
                        <th>Title</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Address</th>
                        <th>Phone number</th>
                        <th>Email</th>
                        <th>ID number</th>
                        <th>Date of birth</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <?php
                if (count($datareport) > 0) {
                    $i = 1;
                    foreach ($datareport as $row) {
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row->created; ?></td>
                                <td><?php echo $row->branchname; ?></td>
                                <td><?php echo $row->schdate; ?></td>
                                <td><?php echo $row->examname; ?></td>
                                <td><?php echo $row->usertitle; ?></td>
                                <td><?php echo $row->userfamilyname; ?></td>
                                <td><?php echo $row->userfirstname; ?></td>
                                <td><?php echo $row->useraddr1; ?></td>
                                <td><?php echo $row->userphone; ?></td>
                                <td><?php echo $row->useremail; ?></td>
                                <td><?php echo $row->useridnumber; ?></td>
                                <td><?php echo $row->userdob; ?></td>
                                <td><?php echo $row->usergender; ?></td>
                            </tr>
                        <?php
                     $i++;   
                    }
                } else {
                    echo "<td colspan=6>You Don't have any record yet</td>";
                }
                ?>

            </table>
        </div>
    </div>
</div>