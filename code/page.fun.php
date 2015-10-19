<?php
	

	/*
	**分页下面的跳页玛
	*/
	function showPage($page,$totalPage, $where=null, $sep="&nbsp"){
		$where = ($where==null)?null:"&".$where;
		$url = $_SERVER['PHP_SELF'];
		$index = ($page == 1)?"首页" : "<a href='{$url}?page=1($where)'>首页</a>";
		$last = ($page==$totalPage) ? "尾页" : "<a href='{$url}?page={$totalPage}{$where}'>尾页</a>";
		$prevPage = ($page >= 1)?$page-1:1;
		$nextPage = ($page >= $totalPage)?$totalPage:$page+1;
		$prev = ($page == 1) ? "上一页" : "<a href='{$url}?page={$prevPage}{$where}'>上一页</a>";
		$next = ($page == $totalPage) ? "下一页" : "<a href='{$url}?page={$nextPage}{$where}'>下一页</a>";
		$str = "总共{$totalPage}页/当前是第{$page}页";
		$p="";
		for ($i=1; $i <= $totalPage; $i++) { 
			# code...当前页无连接
			if ($page == $i) {
				# code...
				$p .= "[{$i}]";
			}else{
				$p .= "<a href='{$url}?page={$i}{$where}'>[{$i}]</a>";
			}
		}
		$pageStr = $str.$sep . $index . $sep. $prev.$sep. $p.$sep . $next.$sep . $last;
		return $pageStr;
	}

	/*
	**分页函数
	*/
	function datePage($page,$PageSize=2,$table){
		$con = new conmysql();
		// $sql = "select book.*,bt.typeName from $table book join tb_booktype bt on book.typeId=bt.id";
		if($table=='tb_bookinfo'){
			$sql = "select book.*,bt.typeName from $table book join tb_booktype bt on book.typeId=bt.id";
		}else{
			$sql = "select * from $table";
		}
		global $totalRows;
		$totalRows = $con->getRowsNum($sql);
		
		global $totalPage;
		$totalPage = ceil($totalRows/$PageSize);
		if ($page<1||$page==null||!is_numeric($page)) {
			# code...
			$page = 1;
		}
		if ($page>$totalPage) {
			# code...
			$page = $totalPage;
		}
		$offset = ($page-1)*$PageSize;
		//$sql = "select book.*,bt.typeName from $table book join tb_booktype bt on book.typeId=bt.id limit {$offset},{$PageSize}";
		if($table=='tb_bookinfo'){
			$sql = "select book.*,bt.typeName from $table book join tb_booktype bt on book.typeId=bt.id limit {$offset},{$PageSize}";
		}else{
			$sql = "select * from $table limit {$offset},{$PageSize}";
		}
		$rows = $con->getRowsArray($sql);

		return $rows;

	}
?>