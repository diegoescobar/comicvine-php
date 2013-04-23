<?php include( 'comicvine_api.php' ); ?>

<form method="get" action="#">
<input type="text" name="query" value="<?php echo $_REQUEST['query']; ?>">
<select name="resource">
<?php $resources_arr = array ('character','concept','origin','object','location','issue','story_arc','volume','publisher','person','team', 'video');
foreach ($resources_arr AS $resources){
	echo '<option value="'.$resources.'"'. selected($_REQUEST['resource'], $resources ) .'>'.$resources.'</option>';
}
?>
</select>
<input type="submit" value="search">
</form>
<pre>
<?php

if (isset($_REQUEST['id'])){
	$nerd = new comicvine_api;
	$results = $nerd->cv_call($_REQUEST['id'], $_REQUEST['resource'], array() );
}else{
	$nerd = new comicvine_api;
	$results = $nerd->search( $_REQUEST['query'], $_REQUEST['resource']);
}

if (isset($_REQUEST['id']) && !empty($results)){
	$xml = new SimpleXMLElement($results);
	$data = $xml->results;
//	var_dump( $data );

	echo $data->volume->name;
	echo '#'. $data->issue_number."\r";
	echo $data->name."\r";
	echo '<img src="'.$data->image->thumb_url . '"/>'."\r";
	echo $data->description;


}

if (!isset($_REQUEST['id']) && !empty($results)){

	echo $results;

	$xml = new SimpleXMLElement($results);
	$data = $xml->results;

	switch ($_REQUEST['resource']) :
    	case 'volume':
			foreach ( $data->volume AS $volume  ){
				echo $volume->id ."\r";
				echo $volume->name . ' (' . $volume->start_year . ')'."\r";
				echo '<img src="'.$volume->image->thumb_url . '"/>'."\r";
				echo '<a href="' . $volume->first_issue->id . '">' . $volume->first_issue->issue_number . '</a>' . ' - ' 
					. '<a href="' . $volume->last_issue->id . '">' . $volume->last_issue->issue_number . '</a>'."\r";
			}
		break;
	
	    case 'object':
			foreach ($data->object AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;

	    case 'character':
			foreach ($data->character AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;

		case 'concept':
			foreach ($data->concept AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'origin':
			foreach ($data->origin AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'location':
			foreach ($data->location AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'issue':
			foreach ($data->issue AS $object ){
				//var_dump( $object ); //echo $object->description;
				echo $object->id ."\r";
				echo $data->volume->name;
				echo $data->volume->issue_number;
				echo $object->name . ' (' . $object->cover_date . ')'."\r";
				echo '<img src="'.$object->image->thumb_url . '"/>'."\r";
			}
		break;
		case 'story_arc':
			foreach ($data->story_arc AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'publisher':
			foreach ($data->publisher AS $object ){
				unset(  $object->aliases );
				unset(  $object->api_detail_url );
				unset(  $object->deck );
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'person':
			foreach ($data->person AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'team':
			foreach ($data->team AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		case 'video':
			foreach ($data->video AS $object ){
				var_dump( $object ); //echo $object->description;
			}
		break;
		default:
			echo 'empty';
	endswitch;

}


function selected($needle, $haystack){
	if ($needle == $haystack){
		return 'selected="selected"';
	}else{
		return false;
	}
}


?>