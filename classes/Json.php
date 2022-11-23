<?php

class Json{
    private $jsonFile = "../name.json";

    public function getData(){
        if(file_exists($this->jsonFile)){
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            return !empty($data)?$data:false;
        }
        return false;
    }

    public function insert($newData){
        if(!empty($newData)){
            $id = time();
            $newData['id'] = $id;

            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            if(!empty($data)){
                array_push($data, $newData);
            }else{
                $data[] = $newData;
            }
            $insert = file_put_contents($this->jsonFile, json_encode($data));

            return $insert?$data:false;
        }else{
            return false;
        }
    }

    public function update($upData, $id){
        if(!empty($upData) && is_array($upData) && !empty($id)){
            $jsonData = file_get_contents($this->jsonFile);
            $data = json_decode($jsonData, true);

            foreach ($data as $key => $value) {
                if ($value['id'] == $id) {
                    if(isset($upData['name'])){
                        $data[$key]['name'] = $upData['name'];
                    }
                    if(isset($upData['email'])){
                        $data[$key]['email'] = $upData['email'];
                    }
                    if(isset($upData['phone'])){
                        $data[$key]['phone'] = $upData['phone'];
                    }
                    if(isset($upData['country'])){
                        $data[$key]['country'] = $upData['country'];
                    }
                }
            }
            $update = file_put_contents($this->jsonFile, json_encode($data));

            return $update?true:false;
        }else{
            return false;
        }
    }

    public function delete($id){
        $jsonData = file_get_contents($this->jsonFile);
        $data = json_decode($jsonData, true);

        $newData = array_filter($data, function ($var) use ($id) {
            return ($var['id'] != $id);
        });
        $delete = file_put_contents($this->jsonFile, json_encode($newData));
        return $delete?true:false;
    }
}