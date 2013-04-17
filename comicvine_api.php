<?php
DEFINE("CV_API_KEY", 'api_key_goes_here');
class comicvine_api {

	private function __signed_post($resource='search',$id = null, $params) {
		$postbody = http_build_query($params);
		if ($id != null){
			$url = "http://www.comicvine.com/api/".$resource.'/'.$id.'/?';
		}else{
			$url = "http://www.comicvine.com/api/".$resource.'/?';
		}
		$query = $url . $postbody;

		$ch = curl_init();

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
		array('field_list', 'limit', 'offset', 'sort', 'filter');	
	}
	
	public function search( $query = '', $resource_type = '' ){
		$params = array( 'query' => $query, 'resource' => $resource_type, 'api_key' => CV_API_KEY);
		return $this->call('search', null, $params);
	}

	function cv_call($id = null, $path = null, $fields = array()){
		if ($id != null && $path != null){
			return $this->call($path, $id, $params);		
		}else{
			return false;
		}
	}
}