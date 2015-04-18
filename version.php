
<?php
// Imprime ejemplo 'Versión actual de PHP: 5.3.8'
echo 'Versión actual de PHP: ' . phpversion();

// Imprime ejemplo '2.0' o nada si la extensión no está habilitada
echo phpversion('tidy');
?>


getTableName{ // obtiene el nombre de la clase
	getClass 
}

getMetadata() //obtiene los metadatos de una tabla o sea los atributos
$classname = get_class(this)
si no esta vacio

pdo query show full columns from $nombre la tablal, me devuelve todas las columnas de la tabla, lo guarda en la variable columns

//Con el active record no necesito declarar los atributos de la clase

//Para declarar un nuevo usuario uso:
	$usuario->usuario = '';
	$usuario->contrasena = '';


	public function __set($property, $value){
	if($property usuario )
	
}


getatributtes usan __Get
setatributos usa __set

public function setattributes($attributes){
	
	foreach 
		$this-> key -> usuario
}


save() //Guarda el active Record 
determina si es un registro nuevo
ejecuta un insert a la base de datos
uso el insert del db command

public function __set property vaue


public function save
	if new record ? inserte : update


public insert
	es newrecord
	col this clumns
	metada this getmeta data
	for each columna
	si la metadata col extra es auto increment
	