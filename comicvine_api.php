<?php
//DEFINE("CV_API_KEY", 'api_key_goes_here');

DEFINE("CV_API_KEY", '2ce95429822b43735ffb93daa15af4701fa9a6e4');

class comicvine_api {

	private function __signed_post($resource='search',$id = null, $params = array()) {
		if (!empty($params['id'])){
			$id = $params['id'];
			unset($params['id']);
			unset($params['resource']);
		}

		$postbody = http_build_query($params);
		if (!empty($id)){
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
	
	private function call($method, $params = array() ) {
		if (!empty($param['id'])){
			$id = $param['id'];
			unset( $param['id'] );
		}else{
			$id = NULL;
		}
		return $this->__signed_post($method, $id, $params);
	}

	private function filter(){
		//Filters
		array('field_list', 'limit', 'offset', 'sort', 'filter');	
	}
	
	public function search( $query = '', $resource_type = '' ){
		$params = array( 'query' => $query, 'resource' => $resource_type, 'resources' => $resource_type,  'api_key' => CV_API_KEY);
		return $this->call('search', $params);
	}

	public function cv_call($id = null, $path = null, $fields = array()){
		if ($id != null && $path != null){
			$params = array( 'id' => $id, 'resource' => $path, 'api_key' => CV_API_KEY);
			return $this->call($path, $params);		
		}else{
			return false;
		}
	}
}