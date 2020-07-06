<?php

//fetch.php

$api_url = "http://localhost/PRODUCT/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';

if(!empty($result) && count($result) > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row->option_no.'</td>
			<td>'.$row->option_type.'</td>
			<td>'.$row->name.'</td>
			<td>'.$row->cost_price.'</td>
			<td>'.$row->hours.'</td>
			<td>'.$row->weight.'</td>
			<td>'.$row->shopping_site.'</td>
			<td>'.$row->tech_talk.'</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="10" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;

?>