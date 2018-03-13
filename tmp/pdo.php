<?php

class test
{
	public function main($args)
	{
		$pdo = new PDO("mysql:host=10.249.7.81;dbname=newhome_db;charset=utf8","aifang","123456");
		//$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$st = $pdo->prepare("SELECT * FROM `cms_school` WHERE `city_id` = ? AND `type` = ? AND (status != ?) LIMIT 10 OFFSET 0 ");

		$r = array (
			0 => '11',
			1 => "jk3oQnLB';update cms_school set type = 1 where id = 211; -- ",
			2 => 0,
		);

		$where = array (
			0 => '11',
			//1 => "'jk3oQnLB\\';select pg_sleep(3); -- '",
			//1 => "jk3oQnLB\';select pg_sleep(3); -- ",
			1 => 'jk3oQnLB\';update newhome_db.cms_school set type = 1 where id = 211; -- ',
			2 => 0,
		);
		try {
			$result = $st->execute((array)$r);
		} catch (Exception $e){
			var_dump('exception',$e);die;
		}
		var_dump($st->fetchAll());
	}
}
