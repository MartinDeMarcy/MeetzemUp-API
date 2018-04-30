<?php

	/**
    * Return JSON Object of the entity User
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
    * Return JSON Object of the entity
    *
    * @return \JSON
    */
    public function toJson($option) {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            $textArray = array();
            if (strcmp($key, "__initializer__") != 0 && strcmp($key, "__cloner__") && strcmp($key, "__isInitialized__")) {
                if ($value instanceof User && is_null($option))
                    $json->$key = $value->getJson();
                else if ($value instanceof User && $option == 1)
                    $json->$key = $value->getId();
                else if ($value instanceof Video && $option == 1)
                    $json->$key = $value->getId();
                else
                   $json->$key = $value;
           }
        }
        return json_encode($json);
    }

    /**
    * Return JSON Object of the entity
    *
    * @return \JSON
    */
    public function toJson($option) {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            $textArray = array();
            if ($value instanceof User && is_null($option))
                $json->$key = $value->getJson();
            else if ($value instanceof User && $option == 1)
                $json->$key = $value->getId();
            else if (strcmp($key, "textParent") == 0) {
                foreach ($value as $textParent) {
                    if ($textParent)
                        array_push($textArray, $textParent->getId());
                }
                $json->$key = json_encode($textArray);
            }
            else if (strcmp($key, "textChild") == 0) {
                foreach ($value as $textChild) {
                    if ($textChild)
                        array_push($textArray, $textChild->getId());
                }
                $json->$key = json_encode($textArray);
            }
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
