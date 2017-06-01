<?php
    namespace Qiniu\Controller;

    use Think\Controller;

    class IndexController extends Controller
    {
        public $arr;

        public function __construct()
        {
        	// 在这里配置基本信息
            parent::__construct();
            $this->arr['DB_NAME'] = '';
            $this->arr['DB_USER'] = '';
            $this->arr['DB_PWD'] = '';
            $this->arr['DB_HOST'] = '';
            $this->arr['AK'] = '';
            $this->arr['SK'] = '';
            $this->arr['BUCKET_NAME'] = '';
            // $this->arr['UPTOKEN_URL'] = 'uptoken.php';
            $this->arr['UPTOKEN_URL'] = '/VideoUpload/index.php/Qiniu/Index/uptoken.html';
            $this->arr['DOMAIN'] = '';
        }

        public function index()
        {
            //读取域名
            $this->assign('domain', $this->arr['DOMAIN']);

            //设置负责处理上传的php文件
            $this->assign('uptokenUrl', $this->arr['UPTOKEN_URL']);

            //加载模板
            $this->display();
        }

        public function uptoken()
        {
            vendor('Qiniu.Auth');

            header('Access-Control-Allow-Origin:*');
            $bucket = $this->arr['BUCKET_NAME'];
            $auth = new \Qiniu\Auth($this->arr['AK'], $this->arr['SK']);

            //notify url   并且在转码后打上视频水印
            vendor('Qiniu.functions');
            $wmImg = \Qiniu\base64_urlSafeEncode('http://rwxf.qiniudn.com/logo-s.png');

            //要进行转码的转码操作
            //$pfopOps = "avthumb/m3u8/wmImage/$wmImg";
            //$pfopOps = "avthumb/mp4;avthumb/m3u8/wmImage/$wmImg";
            $pfopOps = "avthumb/m3u8/wmImage/$wmImg;avthumb/mp4/wmImage/$wmImg";
            $policy = array(
            'persistentOps' => $pfopOps,
            // 'persistentNotifyUrl' => 'http://172.30.251.210:8080/cb.php',

            //回调地址，上传文件成功后，将信息告诉这个地址
            // 'persistentNotifyUrl' => 'http://www.3maio.com/qiniudocs-master/demo/qav/callback.php',
            'persistentNotifyUrl' => '/VideoUpload/index.php/Qiniu/Index/callback.html',
            // 'persistentPipeline' => 'abc',

            //处理的队列的名字
            'persistentPipeline' => 'xuanhaoguo',
            );

            $upToken = $auth->uploadToken($bucket, null, 3600, $policy);

            echo json_encode(array('uptoken' => $upToken));
        }

        public function pfop_status()
        {
            $id = $_GET['id'];
            $url = "http://api.qiniu.com/status/get/prefop?id=$id";

            $resp = file_get_contents($url);

            error_log($resp);

            header("Access-Control-Allow-Origin:*");
            echo $resp;
        }

        public function callback()
        {
            // $DB = D('Index');
            //use Qiniu\Auth;

            $_body = file_get_contents('php://input');
            file_put_contents('/tmp/aa.php',$_body);
            $body = json_decode($_body, true);

            $uid = $body['uid'];
            $fname = $body['fname'];
            $fkey = $body['fkey'];
            $desc = $body['desc'];
            // $uid = 1;
            $ctime = time();

            // $stmt = $DB->prepare('INSERT INTO files_info (uid, fname, fkey, createTime, description) VALUES (:uid, :fname, :fkey, :ctime, :desc)');

            // $ok = $stmt->execute(array(':uid'=>$uid, ':fname' => $fname, ':fkey' => $fkey, ':ctime' => $ctime, ':desc' => $desc));

            header('Content-Type: application/json');
            if (!$ok)
            {
               $resp = array('ret' => 'failed');
               http_response_code(500);
               echo json_encode($resp);
               die();
            }

            $resp = array('ret' => 'success');
            dump($resp);
            echo json_encode($resp);
        }

    }
