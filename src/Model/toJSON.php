<?php

	/**
    * Return JSON Object of the entity
    *
    * @return \JSON
    */
    public function toJson($option) {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            if ($value instanceof User && is_null($option))
                $json->$key = $value->getJson();
            else if ($value instanceof User && $option == 1)
                $json->$key = $value->getId();
            else
               $json->$key = $value;
        }
        return json_encode($json);
    }


	/**
    * Return JSON Object of the entity from an another one
    *
    * @return \JSON
    */
    public function getJson() {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            if (strcmp($key, "__initializer__") != 0 && strcmp($key, "__cloner__") && strcmp($key, "__isInitialized__"))
                $json->$key = $value;
        }

        return $json;
    }