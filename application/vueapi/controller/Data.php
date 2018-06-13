<?php

namespace app\vueapi\controller;
use think\Db;
class Data extends Base
{
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pwd;
    private $db_path;
    private $db_save_path;

    public function _initialize()
    {
        parent::_initialize();
        $db_config = config('database');
        $this->db_name = $db_config['database'];
        $this->db_path = $db_config['mysql_path'];
        $this->db_user = $db_config['username'];
        $this->db_pwd = $db_config['password'];
        $this->db_host = $db_config['hostname'];
        $this->db_save_path = APP_PATH . "..".DS."data".DS;
    }


    /**
     * 首页
     * @return mixed|\think\response\Json
     */
    public function index()
    {
        $res = $this->showSqlList();
        return json(msg(1, $res));
    }

    /**
     * 备份数据
     * @return \think\response\Json
     */
    public function backUp()
    {
        set_time_limit(0);
        ignore_user_abort(true);
        $filename = $this->db_name . '_' . date('Y-m-d_H-i-s') . '.sql';
        $mysql_str = "mysqldump -u{$this->db_user} -p{$this->db_pwd} -h{$this->db_host} {$this->db_name} > {$this->db_save_path}{$filename}";
        system($mysql_str, $return_val);
        if ($return_val) {
            $mysql_str = "{$this->db_path}mysqldump {$this->db_name} -u{$this->db_user} -p{$this->db_pwd} -h{$this->db_host} > {$this->db_save_path}{$filename}";
            system($mysql_str, $return_val);
        }
        return returnRes(!$return_val, '备份');
    }

    /**
     * 数据库还原
     * @return \think\response\Json
     */
    public function restore()
    {
        $filename = $this->request->param('filename');
        set_time_limit(0);
        ignore_user_abort(true);
        if (file_exists(APP_PATH . '../data/' . $filename)) {
            $mysql_str = "mysql {$this->db_name}  -u{$this->db_user}  -p{$this->db_pwd} -h{$this->db_host} < {$this->db_save_path}{$filename}";
            system($mysql_str, $return_val);
            if ($return_val) {
                $mysql_str = "{$this->db_path}mysql {$this->db_name} -u{$this->db_user} -p{$this->db_pwd} -h{$this->db_host}  < {$this->db_save_path}{$filename}";
                system($mysql_str, $return_val);
            }
        }
        return returnRes(!$return_val, '数据库还原');
    }

    /**
     * 系统初始化
     * @return \think\response\Json
     */
    public function initData()
    {
        $sql = "truncate mj_articles";
        $arr = explode(';', $sql);
        foreach ($arr as $vo){
            Db::query($vo);
        }
        return json(msg(1, '', '系统初始化成功'));
    }


    public function downLoad()
    {
        header("Content-type:text/html;charset=utf-8");
        $filename = $this->request->param('filename');
        $file_name=iconv("utf-8","gb2312",$filename);
        $file_path = $this->db_save_path.$file_name;
        $fp=fopen($file_path,"r");
        $file_size=filesize($file_path);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$file_name);
        $buffer=1024;
        $file_count=0;
        //向浏览器返回数据
        while(!feof($fp) && $file_count<$file_size){
            $file_con=fread($fp,$buffer);
            $file_count+=$buffer;
            echo $file_con;
        }
        fclose($fp);
    }


    /**
     * 删除文件
     * @return \think\response\Json
     */
    public function del()
    {
        $filename = $this->request->param('filename');
        $filepath = APP_PATH . '../data/' . $filename; //文件名
        if (!file_exists($filepath)) {
            return json(msg(0, '', '文件不存在'));
        } else {
            $result = unlink($filepath);
            return returnRes($result, '删除');
        }

    }


    /**
     * 显示所有数据列表
     * @return array
     */
    public function showSqlList()
    {
        $basedir = APP_PATH.'../data/';
        $key = 0;
        $files = array();
        if ($dh = opendir($basedir)) {
            while (($file = readdir($dh)) !== false)
                if ($file != '.' && $file != '..') {
                    {
                        if (!is_dir($basedir . "/" . $file)) {
                            if (!(stripos($file, '.sql') === false)) {
                                $key++;
                                $file_info = stat($basedir . "/" . $file);
                                $file_a['title'] = iconv('GBK', 'UTF-8', $file);
                                $file_a['id'] = $key;
                                $file_a['addtime'] = date('Y-m-d H:i:s', $file_info['ctime']);
                                $file_a['size'] = number_format($file_info['size'] / 1024, 2) . 'KB';
                                $files[] = $file_a;
                            }
                        }
                    }
                }
            closedir($dh);
        }
        $files = array_reverse($files);
        return $files;
    }

}
