<?

require('conf.php');
require_once('NaverApi.php');
require_once('Mproxy.php');


$nApi = new NaverApi();
$nApi->clientId = $NA_conf_naver_client_id;
$nApi->clientSecret = $NA_conf_naver_client_secret;
$nApi->mproxy = new Mproxy();
$nApi->mproxy->conn_timeout = 60;
$nApi->mproxy->exec_timeout = 60;



// 	https://developers.naver.com/docs/datalab/shopping/#%EC%87%BC%ED%95%91%EC%9D%B8%EC%82%AC%EC%9D%B4%ED%8A%B8-%EB%B6%84%EC%95%BC%EB%B3%84-%ED%8A%B8%EB%A0%8C%EB%93%9C-%EC%A1%B0%ED%9A%8C

$d7 = date('Y-m-d',time()-(60*60*24*3));
$dn = date('Y-m-d');
$category = array();
$category[]=array(
	'name'=>'패션의류',"param"=>["50000000"]
);
$category[]=array(
	'name'=>'패션의류 - 니트/스웨어',"param"=>["50000805"]
);
$category[]=array(
	'name'=>'생활/건강',"param"=>["50000008"]
);
$data = $nApi->v1_datalab_shopping_categories($d7,$dn,'date',$category);
print_r($data);
echo "\n\n";
$d7 = date('Y-m-d',time()-(60*60*24*7));
$dn = date('Y-m-d');
$keywordGroups = array();
$keywordGroups[]=array(
	'groupName'=>'삼성',"keywords"=>["삼성","samsung"]
);
$keywordGroups[]=array(
	'groupName'=>'엘지',"keywords"=>["엘지","LG"]
);
$keywordGroups[]=array(
	'groupName'=>'샤오미',"keywords"=>["샤오미","Xiaomi"]
);
$data = $nApi->v1_datalab_search($d7,$dn,'date',$keywordGroups);
print_r($data);