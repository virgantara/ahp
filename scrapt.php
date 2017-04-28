<?php
$html = file_get_contents('http://pokemondb.net/evolution'); //get the html returned from the following url


$pokemon_doc = new DOMDocument();

libxml_use_internal_errors(TRUE); //disable libxml errors

if(!empty($html)){ //if any html is actually returned

	$pokemon_doc->loadHTML($html);
	libxml_clear_errors(); //remove errors for yucky html
	
	$pokemon_xpath = new DOMXPath($pokemon_doc);

	$pokemon_list = array();

$pokemon_and_type = $pokemon_xpath->query('//span[@class="infocard-tall "]');

if($pokemon_and_type->length > 0){	
	
	//loop through all the pokemons
	foreach($pokemon_and_type as $pat){
		
		//get the name of the pokemon
		$name = $pokemon_xpath->query('a[@class="ent-name"]', $pat)->item(0)->nodeValue;
		
		$pkmn_types = array(); //reset $pkmn_types for each pokemon
		$types = $pokemon_xpath->query('small[@class="aside"]/a', $pat);

		//loop through all the types and store them in the $pkmn_types array
		foreach($types as $type){
			$pkmn_types[] = $type->nodeValue; //the pokemon type
		}

		//store the data in the $pokemon_list array
		$pokemon_list[] = array('name' => $name, 'types' => $pkmn_types);
		
	}
}

//output what we have
echo "<pre>";
print_r($pokemon_list);
echo "</pre>";
}
?>