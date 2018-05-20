<?php

$current_view = $config['VIEW_PATH'].'cars'.DS;
$file = $config['DATA_PATH'].'cars.txt';

switch (get('action')) {
	
	case 'view': {
		$view = $current_view.'view.html';
		$cars = file($file);
		break;
	}

	case 'delete':{
		$view = $current_view.'delete.html';
		$id = get('id');
		$cars = file($file);
		foreach($cars as $index=>$car){
			$fields = explode(',',$car);
			if($fields[0] == $id){
				unset($cars[$index]);
				break;
			}
		}
		file_put_contents($file, implode('', $cars));
		header('location:/?page=cars&action=view');
		break;
	}

	case 'update':{
		$view = $current_view.'update.html';
		$cars = file($file);
		$id = get('id');
		$cartoupdate='';
		foreach($cars as $index=>$car){
			$fields = explode(',',$car);
			if($fields[0] == $id){
				$cartoupdate = $fields;
				break;
			}
		}
		break;
	}

	case 'doUpdate':{
		$id = get('id');
		$updated_car = $id . ',' . get('make') . ',' . get('model') . ','. get('year') . ','. get('price').PHP_EOL;
		$cars = file($file);
    foreach ($cars as $index => $car) 
    {
      $fields = explode(',',$car);
      if ($fields[0] == $id) {
        $cars[$index] = $updated_car;
        break;
      }
    }
    file_put_contents($file,implode('',$cars));
    header('location: /?page=cars&action=view');
	}

	case 'add':{
		$view = $current_view.'add.html';
		break;
	}

	case 'doAdd':{
        
    $new_car = nextID() . ','.get('make') . ',' . get('model') . ','. get('year'). ','.get('price') . PHP_EOL;
    $cars = file($file);
    array_push($cars,$new_car);
    file_put_contents($file,implode('' , $cars));
    header('location: /?page=cars&action=view');
    break;
  }
}