<?php

namespace Kanboard\Model;

use Kanboard\Core\Base;

/**
 * Column Model
 *
 * @package  Kanboard\Model
 * @author   Frederic Guillot
 */
class UpDownloadLogModel extends Base
{
    /**
     * SQL table name
     *
     * @var string
     */
    const TABLE = 'up_download_logs';

    /**
     * Get a column by the id
     *
     * @access public
     * @param  integer  $column_id    Column id
     * @return array
     */
    public function getById($column_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->findOne();
    }

    public function getAllByUserId($user_id)
    {
        return $this->db->table(self::TABLE)->eq('user_id', $user_id)->desc('id')->findAll();
    }

    public function getAllByTaskId($task_id)
    {
        return $this->db->table(self::TABLE)->eq('task_id', $task_id)->desc('id')->findAll();
    }

    public function getAll()
    {
        return $this->db->table(self::TABLE)->desc('id')->findAll();
    }

    public function create($user, $task)
    {
        $values = array(
            'user_id' => $user['id'],
            'user_name'=>$user['username'],
            'task_id' => $task['id'],
            'task_title'=>$task['title'],
            'created_at'=>time()
        );
        return $this->db->table(self::TABLE)->persist($values);
    }

    public function downloadLog($user, $task,$file)
    {
        $content = date('Y-m-d H:i:s').'-'.$user['username'].'-'.$file['name'].'-'.$task['id'].'-'.$task['title'];
        $dir = 'data/log';
        if(!file_exists($dir)){
            mkdir ($dir,0777,true);
        }
        $file = $dir.'/download-'.date('Y-m-d').'.log';
        file_put_contents($file,$content."\t\n",FILE_APPEND);
    }

    public function getLog($m =2)
    {
        return $this->readLog($m);
    }
    public function readLog($m=1)
    {
        $dir = 'data/log';
        $m = $m>1?$m:1;
        $data = [];
        for($i=0;$i<$m;$i++){
            $time = date('Y-m',strtotime("-$i month"));
            $path = $dir.'/'.$time.'.log';
            $file = file_get_contents($path,true)?:'';
            if($file){
                $file = explode("\t\n",$file);
                $len = count($file)-1;
                for($j=$len;$j>=0;$j--){
                    if(!empty($file[$j])){
                        $data[] = $file[$j];
                    }
                }
            }
        }
        return $data;
    }


    /**
     * Remove a column and all tasks associated to this column
     *
     * @access public
     * @param  integer  $column_id    Column id
     * @return boolean
     */
    public function remove($column_id)
    {
        return $this->db->table(self::TABLE)->eq('id', $column_id)->remove();
    }

    public function noteEvents ($user_id = null, $limit = null)
    {
        if (!$user_id) {
            $user_id = $this->userSession->getId();
        }
        if (!$limit) {
            return $this->getAll($user_id);
        }
        return $this->db->table(self::TABLE)->limit($limit)->desc('id')->eq('id', $user_id)->findAll();
    }
}
