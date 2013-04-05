<?php
DEFINE("CV_API_KEY", 'api_key_goes_here');
class comicvine_api {
	/****
	 example Issue
	 * http://www.comicvine.com/api/issue/7/?api_key=2ce95429822b43735ffb93daa15af4701fa9a6e4
	
	 * http://www.comicvine.com/api/volume/32341/?api_key=2ce95429822b43735ffb93daa15af4701fa9a6e4
	 * http://www.comicvine.com/api/search/?api_key=2ce95429822b43735ffb93daa15af4701fa9a6e4&query=Invincible%20Iron%20Man&resource=volumes&format=xml
	 * http://www.comicvine.com/api/search/?api_key=2ce95429822b43735ffb93daa15af4701fa9a6e4&query=Superior%20Spider-Man
	 */

	private function __signed_post($resource='search',$id = null, $params) {
		$postbody = http_build_query($params);
		if ($id != null){
			$url = "http://www.comicvine.com/api/".$resource.'/'.$id.'/?';
		}else{
			$url = "http://www.comicvine.com/api/".$resource.'/?';
		}
		$query = $url . $postbody;
			
		$ch = curl_init();
		// Set query data here with the URL
		curl_setopt($ch, CURLOPT_URL, $url . $postbody);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, '3');
		$content = trim(curl_exec($ch));
		curl_close($ch);
	
		return $content;
			
	}
	
	function call($method, $params=array()) {
		return $this->__signed_post($method, $params);
	}
	
	
	private function filter(){
		//Filters
		array('field_list',
				'limit',
				'offset',
				'sort',
				'filter');	
	}
	
	public function search( $query = '', $resource_type = '' ){
		//search/?api_key=2ce95429822b43735ffb93daa15af4701fa9a6e4&query=Superior%20Spider-Man
		//resources,
		//'character','concept','origin','object','location','issue',
		//				 'story_arc','volume','publisher','person','team','video');
		//$this->filter();
		
		$params = array( 'query' => $query, 'resource' => $resource_type, 'api_key' => CV_API_KEY);
		//$this->call('search', $params);
		return $this->call('search', null, $params);
	}


	function issue ($id = null, $fields = array()){
		//URL: /issue/id
		if ($id != null){
			return $this->call('issue', $id, $params);		
		}else{
			return false;
		}
	}
	
	
	function volume ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('volume', $id, $params);
		}else{
			return false;
		}
	}
	 function volumes  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('volumes', $id, $params);
		}else{
			return false;
		}
	}
	
	function origin  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('origin', $id, $params);
		}else{
			return false;
		}
	}
	
	function origins  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('origins', $id, $params);
		}else{
			return false;
		}
	}
	
	function person ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('person', $id, $params);
		}else{
			return false;
		}
	}
	
	function people  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('people', $id, $params);
		}else{
			return false;
		}
	}
	
	function character  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('character', $id, $params);
		}else{
			return false;
		}
	}

	 function characters ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('characters', $id, $params);
		}else{
			return false;
		}
	}
	
	function team  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('team', $id, $params);
		}else{
			return false;
		}
	}
	
	function teams  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('teams', $id, $params);
		}else{
			return false;
		}
	}
	 function concept ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('concept', $id, $params);
		}else{
			return false;
		}
	}
	
	function concepts ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('concepts', $id, $params);
		}else{
			return false;
		}
	}
	

	function location  ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('location', $id, $params);
		}else{
			return false;
		}
	}
	
	function locations ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('locations', $id, $params);
		}else{
			return false;
		}
	}
	function object ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('object', $id, $params);
		}else{
			return false;
		}
	}
	function objects ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('objects', $id, $params);
		}else{
			return false;
		}
	}
	 function origin ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('origin', $id, $params);
		}else{
			return false;
		}
	}
	 function power ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('power', $id, $params);
		}else{
			return false;
		}
	}
	
	function powers ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('powers', $id, $params);
		}else{
			return false;
		}
	}
	
	function publisher ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('publisher', $id, $params);
		}else{
			return false;
		}
	}
	
	function publishers ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('publishers', $id, $params);
		}else{
			return false;
		}
	}
	
	
	 function story_arc ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('story_arc', $id, $params);
		}else{
			return false;
		}
	}
	
	function story_arcs ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('story_arcs', $id, $params);
		}else{
			return false;
		}
	}
	
	function movie ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('movie', $id, $params);
		}else{
			return false;
		}
	}

	function movies ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('movies', $id, $params);
		}else{
			return false;
		}
	}
	
	
	/**************************
	 Video Functions */
	function video ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('video', $id, $params);
		}else{
			return false;
		}
	}
		
	function videos ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('videos', $id, $params);
		}else{
			return false;
		}
	}

	function video_type ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('video_type', $id, $params);
		}else{
			return false;
		}
	}

	function video_types ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('video_types', $id, $params);
		}else{
			return false;
		}
	}

	/*****************
	 * chat functions */
	function chat ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('chat', $id, $params);
		}else{
			return false;
		}
	}

	function chats ($id = null, $fields = array()){
		if ($id != null){
			return $this->call('chats', $id, $params);
		}else{
			return false;
		}
	}
}