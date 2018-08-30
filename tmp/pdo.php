<?php

class test
{
	public function main($args)
	{
		$pdo = new PDO("mysql:host=10.249.7.81;dbname=newhome_db;charset=utf8","aifang","123456");
		//$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$st = $pdo->prepare("SELECT * FROM `e_2345_yangd_ssp`.`flownews_category` WHERE 1 AND status!=:status0 AND platform=:platform1 AND ( FIND_IN_SET(:short_name,short_name)  OR  FIND_IN_SET(:mapping_categories,mapping_categories)  OR  FIND_IN_SET(:mapping_keywords,mapping_keywords) ) ORDER BY id DESC LIMIT 0, 50");

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
