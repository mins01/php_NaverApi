<?
/**
 * 네이버 API
 * 제작자 : 공대여자 (mins01.com)
 * 라이센스 : MIT + '공대여자는 예쁘다'를 나타낼 수 있어야합니다.
 */


class NaverApi{
	public $clientId = '';
	public $clientSecret = '';
	public $mproxy = null;
	public function __construct(){
		
	}
	/*
	
	POST /v1/datalab/shopping/categories HTTP/1.1
	Host: openapi.naver.com
	X-Naver-Client-Id: {애플리케이션 등록 시 발급받은 클라이언트 아이디 값}
	X-Naver-Client-Secret: {애플리케이션 등록 시 발급받은 클라이언트 시크릿 값}
	Content-Type: application/json
	Content-Length: 360
	 */
	private function getContent($url,$method,$postRaw=null){
			if(!isset($this->mproxy)){
				throw new Exception('not exists mproxy', 1);
			}
			$cookieRaw=null;
			$headers=array();
			$headers['X-Naver-Client-Id'] = $this->clientId;
			$headers['X-Naver-Client-Secret'] = $this->clientSecret;
			$headers['Content-Type'] = 'application/json';
			$opts[CURLOPT_SSL_VERIFYPEER] = false;
			$opts[CURLOPT_SSL_VERIFYHOST] = 2;
			// $opts[CURLOPT_CAINFO] = dirname(__FILE__).'\cacert.pem';
			// print_r($opts);
			switch ($method) {
				case 'get':
				$res = $this->mproxy->get($url,$cookieRaw,$headers,$opts);
				break;
				case 'post':
				// $headers['Content-Length'] = strlen($postpostRaw);
				// var_dump($postRaw);
				$res = $this->mproxy->post($url,$postRaw,$cookieRaw,$headers,$opts);
				break;
				default:
					// code...
					break;
			}
			if($res['errorno'] != 0){
				throw new Exception($res['errormsg'], $res['errorno']);
			}
			return $res['body'];
	}
	/**
	 * 쇼핑인사이트 분야별 트렌드 조회
	 * @param  [type] $startDate [description]
	 * @param  [type] $endDate   [description]
	 * @param  string $timeUnit  [description]
	 * @param  array  $params    [description]
	 * @return [type]            [description]
	 */
	//	https://developers.naver.com/docs/datalab/shopping/#%EC%87%BC%ED%95%91%EC%9D%B8%EC%82%AC%EC%9D%B4%ED%8A%B8-%EB%B6%84%EC%95%BC%EB%B3%84-%ED%8A%B8%EB%A0%8C%EB%93%9C-%EC%A1%B0%ED%9A%8C
	public function v1_datalab_shopping_categories($startDate,$endDate,$timeUnit='date',$category=array(),$params=array()){
		$url = 'https://openapi.naver.com/v1/datalab/shopping/categories';
		$method = 'post';
		$bodyArr = $params;
		$bodyArr['startDate'] = $startDate;
		$bodyArr['endDate'] = $endDate;
		$bodyArr['timeUnit'] = $timeUnit;
		$bodyArr['category'] = $category;
		// print_r($bodyArr);
		$postRaw = json_encode($bodyArr);
		// print_r($postRaw);
		$body = $this->getContent($url,$method,$postRaw);
		return json_decode($body,1);
	}
	/**
	 * 네이버 통합 검색어 트렌드 조회
	 * @param  [type] $startDate     [description]
	 * @param  [type] $endDate       [description]
	 * @param  string $timeUnit      [description]
	 * @param  array  $keywordGroups [description]
	 * @return [type]                [description]
	 */
	//https://developers.naver.com/docs/datalab/search/#%EB%84%A4%EC%9D%B4%EB%B2%84-%ED%86%B5%ED%95%A9-%EA%B2%80%EC%83%89%EC%96%B4-%ED%8A%B8%EB%A0%8C%EB%93%9C-%EC%A1%B0%ED%9A%8C
	public function v1_datalab_search($startDate,$endDate,$timeUnit='date',$keywordGroups=array(),$params=array()){
		$url = 'https://openapi.naver.com/v1/datalab/search';
		$method = 'post';
		$bodyArr = $params;
		$bodyArr['startDate'] = $startDate;
		$bodyArr['endDate'] = $endDate;
		$bodyArr['timeUnit'] = $timeUnit;
		$bodyArr['keywordGroups'] = $keywordGroups;
		// print_r($bodyArr);
		$postRaw = json_encode($bodyArr);
		// print_r($postRaw);
		$body = $this->getContent($url,$method,$postRaw);
		return json_decode($body,1);
	}
// 
// 
}