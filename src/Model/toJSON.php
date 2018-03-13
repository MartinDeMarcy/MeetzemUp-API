<?php

/**
* Return JSON Object of the entity
*
* @return \JSON
*/
public function toJson() {
	$json = new \stdClass();

	foreach ($this as $key => $value)
	   $json->$key = $value;

	return json_encode($json);
}