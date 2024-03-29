<?php

function gen_latest_msg() {
// Connecting to database

$tbody = '';
$connection = mysqli_connect("localhost", "root", "continuum", "reporting");
//$db_name = 'reporting';
//mysql_select_db($db_name, $connection);

$lastday = time() - 86400;
$query = "SELECT type, code, text FROM messages ORDER BY uid desc limit 10;";
$result = mysqli_query($connection, $query);

if ($result === false) {
	return (false);
}


// Display table
while ($table = mysqli_fetch_row($result)) {
	mysqli_data_seek($result, 0);
	if (mysqli_num_rows($result)) {
		$inc = 0;
		mysqli_data_seek($result, 0);
		while($row = mysqli_fetch_row($result)) {
			//if ($inc >= $startpt && $inc <= $endpt) {
				$tbody .= "<tr>\n";
				foreach($row as $key=>$value) {
					$tbody .= '<td>'.htmlentities(trim(preg_replace("/\s+/", " ", $value)))."</td>\n";
				}
				$tbody .= "</tr>\n";
			//}
			//$inc += 1;
			//$count++;
		}
	}
}

$result = '<div style"margin-top:3px;" class="panel panel-default">

                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive" >
                                        <table class="table table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Type</th>
                                                    <th>Code</th>
                                                    <th>Message</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            '.$tbody.'
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
					';

return $result;
}

?>