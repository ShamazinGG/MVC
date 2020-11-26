<?php


class Model
{
    protected $storageFilePath;
    protected $attributes = [];

    function getAll()
    {
        $file = $this->storageFilePath;
        return json_decode(file_get_contents($file), true);

    }

    function getById($id)
    {
        $attributes = $this->getAll();
        foreach ($attributes as $attribute) {
            if ($attribute['id'] == $id) {
                return $attribute;
            }
        }
        return null;
    }

    function create($data)
    {
        $attributes = $this->getAll();
        $data['id'] = uniqid();
        $attributes[] = $data;
        $this->putJson($attributes);
        return $data;
    }

    function update($data, $id)
    {
        $file = $this->storageFilePath;
        $attributes = $this->getAll();
        foreach ($attributes as $i => $attribute) {
            if ($attribute['id'] == $id) {
                $attributes[$i] = array_merge($attribute, $data);
            }
        }
        file_put_contents( $file, json_encode($attributes), JSON_PRETTY_PRINT);
    }

    function delete($id)
    {
        $attributes = $this->getAll();
        foreach ($attributes as $i => $attribute) {
            if ($attribute['id'] == $id) {
                array_splice($attributes, $i, 1);
            }
        }
        $this->putJson($attributes);
    }

    function putJson($attributes)
    {
        $file = $this->storageFilePath;
        file_put_contents( $file, json_encode($attributes  , JSON_PRETTY_PRINT));
    }


    function validate($attribute, &$errors)
    {

    }
    public function getId()
    {
        $url = $_SERVER['REQUEST_URI'];
        $routeParts = explode('/', $url);
        $id = $routeParts[2];
        return $id;
    }




}