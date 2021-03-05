<?php
class column_libs {
    public $parent_list;
    private $child_list;
    public $top_list;
    private $source_list;
    public function __construct($get_deleted=null){
		$this->obj = & get_instance();
    }

    public function get_child($_id, $get_child=false){  //根据_id获取他的子类,当$get_child时会递归向下获取其子类
        $child = array();
        foreach($this->source_list as $k => $v){
            $cid = $v['_id']['$id'];
            if($v['parent_id'] == $_id){
                $column = array(
                    '_id' => $cid,
                    'name' => $v['name'],
                    'is_delete' => $v['is_delete'],
                );
                if($get_child) {
                    if(self::get_child($cid)){
                        $column['child'] = self::get_child($cid, true);
                    }
                }
                $child[] = $column;
            }
        }
        return $child;
    }

    public function get_top(){  //获取顶级目录
        $this->top_list = array();
        foreach($this->source_list as $k => $v){
            if(empty($v['parent_id'])){
                $_id  =$v['_id']['$id'];
                $column = array(
                    '_id' => $_id,
                    'name' => $v['name'],
                    'is_delete' => $v['is_delete'],
                );
                $this->top_list[] = $column;
            }
        }
        return $this->top_list;
    }

    private function _get_format_list(){   //获取树形的格式化后的列表
        $this->parent_list = array();
        foreach($this->source_list as $k => $v){
            if(empty($v['parent_id'])){
                $_id  =$v['_id']['$id'];
                $column = array(
                    '_id' => $_id,
                    'name' => $v['name'],
                    'is_delete' => $v['is_delete'],
                    'child' => self::get_child($_id, true), //获取子类
                );
                $this->parent_list[] = $column;
            }
        }
    }

    public function get_tree($get_deleted=false){     //获取分类树
        $this->source_list = $this->obj->column_model->getcolumn(null, $get_deleted); //获取数据
        $this->_get_format_list();
        return $this->parent_list;
    }

    public function get_name($_id){    //根据_id获取标题
    }

     public function get_source(){     //获取全部栏目数组
         $this->source_list = $this->obj->column_model->getcolumn(); //获取数据
         $source_array = array();
         foreach($this->source_list as $k=>$v){
             $_id = $v['_id']['$id'];
             $source_array[$_id] =$v['name'];
         }
        return $source_array;
    }
}
