<?php

namespace app\components;
use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget {
    
    public $data;
    public $tree;
    public $menuHmtl;
    public $tpl;
    
    public function init() {
        parent::init();
        if($this->tpl  === null) {
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
//        ob_start(); 
    }
    
    public function run() {
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHmtl = $this->getMenuHtml($this->tree);
        return $this->menuHmtl;
    }
    
    protected function getTree() {
	$tree = [];
	foreach ($this->data as $id=>&$node) {    
		if (!$node['parent_id']){
                    $tree[$id] = &$node;
		}else{
                    $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
                }
        }
        return $tree;
    }
    
    	protected function getMenuHtml($tree) {
		$str = '';
		foreach ($tree as $category) {
			$str .= $this->catToTemplate($category);
		}
		return $str;
	}
        
        protected function catToTemplate($category) {
		ob_start(); 
		require __DIR__ . '/menu_tpl/' . $this->tpl; 
		return ob_get_clean();
	}


}