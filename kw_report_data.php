<?php
/**
 * 关键词排名查询1
 */
require_once(dirname(__FILE__)."/config.php");
require_once(DEDEINC."/datalistcp.class.php");
$where = ' where aid > 0 ';
if($client){
    $where .= ' and client = "'.$client.'"';
}
if($engines){
    $where .= ' and engines = "'.$engines.'"';
}
$start = ($page - 1) * $limit;
$query_count = "select * from #@__keywords_rank $where order by engines desc";
$query_data = "select * from #@__keywords_rank $where order by engines desc limit $start,$limit";
$dsql->Execute('count',$query_count);
$count = $dsql->GetTotalRow($rsid="count");
$dsql->Execute('me',$query_data);
$data = [];
while($arr = $dsql->GetArray())
{
    $data[] = $arr;
}
echo json_encode(['code' => 0, 'msg' => '', 'data' => $data, 'count' => $count]);