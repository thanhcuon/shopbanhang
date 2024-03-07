<?php
namespace App\Components;


class Recusive{
    private $data;
    private $htmlSlelect = '';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function categoryRecusive($parent_id,$id = 0,$text=''){

        foreach ($this->data as $value) {
            if ($value ['parent_id'] == $id ) {
                if (!empty($parent_id) && $parent_id == $value ['id']){
                    $this->htmlSlelect .= "<option selected value='".$value['id']."'>".$text. $value['name'] . "</option>";
                }else{
                    $this->htmlSlelect .= "<option value='".$value['id']."'>".$text. $value['name'] . "</option>";
                }

                $this->categoryRecusive($parent_id,$value['id'],$text.'--');
            }
        }
        return $this->htmlSlelect;
    }
}

