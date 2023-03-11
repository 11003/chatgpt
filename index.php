<?php
$log = file_get_contents(__DIR__ . "/chat.txt"); // 读取文件内容
$lines = explode("----------------", $log); // 分离每行日志

$ips = array(); // 用于存储IP地址及其发布的次数
foreach ($lines as $line) {
    if (strpos($line, "|") !== false) { // 如果这行包含IP地址
        $ip = trim(explode("|", $line)[0]); // 获取IP地址并去除空格
        $date = explode(" ", trim(explode("|", $line)[1]))[0]; // 获取日期
        if ($date == date("Y-m-d")) { // 如果日期是当天
            if (!isset($ips[$ip])) {
                $ips[$ip] = 0;
            }
            $ips[$ip]++; // 增加这个IP地址的发布次数
        }
    }
}
$limit = 30;
foreach ($ips as $ip => $count) {
    if($_SERVER["REMOTE_ADDR"] == $ip && $count >= $limit) {
        echo "您今天已经超过了 $limit 次了，明天再来吧！\n\n";
        exit();
    }
}
?>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>MuscleWiki健身AI助手</title>
	<link rel="stylesheet" href="css/common.css?v1.1">
	<link rel="stylesheet" href="css/wenda.css?v1.1">
	<link rel="stylesheet" href="css/hightlight.css">
</head>

<body>
	<div class="layout-wrap">
		<header class="layout-header">
			<div class="container" data-flex="main:justify cross:start">
                <div class="header-logo">
                    <h2 class="logo"><a class="links" href="https://musclewiki.cn/" title="MuscleWiki健身AI助手"><span class="logo-title">健身AI助手</span></a></h2>
                </div>
				<div class="header-logo">
					<span class="logo"><a class="links" id="clean" title="清空对话信息"><span class="logo-title">清空对话信息</span></a></>
				</div>
			</div>
		</header>
		<div class="layout-content">
			<div class="container">
				<article class="article" id="article">
					<div class="article-box">
<!--						<div class="precast-block" data-flex="main:left">-->
<!--							<div class="input-group">-->
<!--								<span style="text-align: center;color:#9ca2a8">&nbsp;&nbsp;连续对话：</span>-->
<!--								<input type="checkbox" id="keep" checked style="min-width:220px;">-->
<!--								<label for="keep"></label>-->
<!--								<span style="text-align: center;color:#9ca2a8">&nbsp;&nbsp;&nbsp;&nbsp;默认开启</span>-->
<!--							</div>-->
<!--						</div>-->
						<ul id="article-wrapper">
                            <li class="article-title"><pre>您好，我是MuscleWiki健身AI助手。有任何健身问题都可以问我哦~</pre></li>
						</ul>
						<div class="creating-loading" data-flex="main:center dir:top cross:center">
							<div class="semi-circle-spin"></div>
						</div>
						<div id="fixed-block">
							<div class="precast-block" id="kw-target-box" data-flex="main:left cross:center">
								<div id="target-box" class="box">
									<input type="text" name="kw-target" placeholder="请点此提问" id="kw-target"  autofocus />
								</div>
								<div class="right-btn layout-bar">
									<p class="btn ai-btn bright-btn" id="ai-btn" data-flex="main:center cross:center"><i class="iconfont icon-wuguan"></i>发送</p>
								</div>
							</div>
						</div>
					</div>
				</article>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.cookie.min.js"></script>
	<script src="js/layer.min.js" type="application/javascript"></script>
	<script src="js/chat.js?v2.8"></script>
	<script src="js/highlight.min.js"></script>
	<script src="js/showdown.min.js"></script>
</body>

</html>
