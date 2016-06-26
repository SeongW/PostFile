<?php
    include './db_connect.php';
    header('Content-type: text/html; charset=utf-8');

    // 获取网页内容
    function getPageContent($link)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $output = curl_exec($ch);
        if ($output === false) {
            return 'cURL Error: '.curl_error($ch);
        } else {
            return $output;
        }
        curl_close($ch);
    }

    // 分析网站url
    function getLegalURL($content)
    {
        $href = "/(?<=href=\")(http\:\/\/www\.zealer\.com\/data[^\>^\}^\"-]*)(?=\")/i";
        $get_url_result = preg_match_all($href, $content, $out);
        if ($get_url_result) {
            return $out;
        } else {
            return;
        }
    }

    function get_web_url()
    {
        // 新发现的url
        $new_url = array();
        // 初始URL
        $link = 'http://www.zealer.com/data';
        $m = md5($link);
        $new2_url[$m] = $link;
        $new_url = array();
        // db connect
        $conn = getConnection();

        // 每个网站深入3层
        for ($i = 0; $i < 4; ++$i) {
            // 对添加的url进行分析
            $new_url = $new2_url;
            $new2_url = array();
            foreach ($new_url as $md5 => $url) {

                // 一个新的url 的 内容
                $link_arr = getLegalURL(getPageContent($url));
                // 添加新发现的url进数据库
                foreach ($link_arr[0] as $var) {
                    $md5 = md5($var);
                    $sql = 'insert into link_url values ("'.$md5.'","'.$var.'");';
                    $result = $conn->query($sql);
                    if ($result) {
                        $new2_url[$md5] = $var;
                    } else {
                        echo '<br/>Errorcode: '.mysqli_errno($conn);
                    }
                }
            }
        }
    }

    function get_pic_url($content)
    {
        $href = '/(http\:\/\/img[^\>^\}^\"-]*)(?=\")/i';
        $get_url_result = preg_match_all($href, $content, $out);
        if ($get_url_result) {
            return $out;
        } else {
            return;
        }
    }

    function save_pic_url()
    {
        $conn = getConnection();
        $sql = 'select url from link_url';
        $result = $conn->query($sql);
        if ($result) {
            while ($res = mysqli_fetch_row($result)) {
                $pic_url = get_pic_url(getPageContent($res[0]));
                if ($pic_url != null) {
                    foreach ($pic_url[0] as $url) {
                        $md5 = md5($url);
                        $insert_sql = 'insert into pic_url values("'.$md5.'","'.$url.'")';
                        $conn->query($insert_sql);
                    }
                }
            }
        }
    }

    function get_pic()
    {
        $conn = getConnection();
        $sql = 'select url from pic_url';
        $result = $conn->query($sql);
        if ($result) {
            while ($res = mysqli_fetch_row($result)) {
                get_pic_name($res);
            }
        }
    }

    function get_pic_name($link)
    {
        $url = $link[0];
        $pattern = '/\w*(?=\.jpg)/i';
        preg_match($pattern, $url, $name);
        downImage($url, $name[0]);
        echo 'download:'.$name[0].'.jpg<br/>';
    }

    function downImage($url, $name)
    {
        ob_start();
        readfile($url);
        $img = ob_get_contents();
        ob_end_clean();
        $size = strlen($img);
        $fp2 = fopen('./img/'.$name.'.jpg', 'a');
        fwrite($fp2, $img);
        fclose($fp2);
    }

    // 爬网站
    get_web_url();
    // 爬图片
    save_pic_url();
    //下载图片
    get_pic();
