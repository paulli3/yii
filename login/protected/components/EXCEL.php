<?php
 
/*
 * 
 * $excel = new Excel_my(ROOT.'aa.xls');
 $excel->addHead();
$array = array(
 array(array('val'=>'111','colspan'=>1,'rowspan' => '2'),array('val'=>'222'),array('val'=>'333'),array('val'=>'444')),
 array(array('val'=>'','rowspan' => '8'),array('val'=>'333')),
 array(array('val'=>'','rowspan' => '9'),array('val'=>'333')),
 array(array('val'=>'','rowspan'=>2)),
);
$excel->addArray($array);
 
$excel->addFoot();
 * 
 * 
 * 
 */
class Excel
{
 private static $header = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<Workbook xmlns=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:x=\"urn:schemas-microsoft-com:office:excel\"
 xmlns:ss=\"urn:schemas-microsoft-com:office:spreadsheet\"
 xmlns:html=\"http://www.w3.org/TR/REC-html40\">";
 
 
  private static $footer = "</Workbook>";
  
  public  static $worksheet_title = "Table1";
  
  private static $filePath ;
  
  private static $tofile ;
  
  private static $currentLine = 0;  //当前行数
  
  private static $lastColsspanIndex = 1; //最后合并单元格的数量
  
  public function __construct($filePath,$tofile = false)
  {
   self::$filePath = $filePath;
   
   self::$tofile = $tofile;
   
   if (file_exists($filePath))
   {
    @ unlink($filePath);
   }
   
   
  }
  /*私有方法，不允许外部调用*/
  private  static function addRow (array $row)
  {
    self::$currentLine++;  //当前行数加1
    //ss:Index=\"". self::$currentLine ."\"
    $cells = "<Row ss:Index=\"". self::$currentLine ."\" >\n";
    
    $colspans = array(0);//用于存放 合并行的时候，具体合并多少行，并且筛选出最大的一个，加到当前行上去。
    
    foreach ($row as $k => $v):
    
     $cellAttr = "";
     
     
     //数据类型
    if (isset($v['type']))
         {
          $type = $v['type'];      
         }
         else 
         {
          $type = 'String';
         }
         
         
   
         if (isset($v['colspan']))
         {
          $cellAttr .=  ' ss:MergeAcross="'.$v['colspan'].'" '; //合并列
          
          //self::$lastColsspanIndex = intval($v['colspan']) + 1;
         }
 
    if (isset($v['colIndex']))
         {
          $cellAttr .=  '  ss:Index="'.$v['colIndex'].'" '; //列所在的位置   合并单元格了 也没影响。  第8列就是G那一列
         }
         
         if (isset($v['rowspan']))
         {
          $cellAttr .= ' ss:MergeDown="'.$v['rowspan'].'" ';  //合并行
          
          $colspans[] = $v['rowspan'];
 
         }
         if (isset($v['val']))
         {
          $val = $v['val'];
         }
   if (self::$currentLine%2 != 0)
   {
    $style = 'ss:StyleID="s64"';
   }
   else 
   {
    $style = 'ss:StyleID="s65"';
   }
         $cells .= "<Cell $cellAttr  $style ><Data ss:Type=\"{$type}\">" . $val . "</Data></Cell>\n"; 
 
         endforeach;
         
         $cells .= "</Row>\n";
         
         self::$currentLine += intval(max($colspans));
         
         self::write($cells);
  }
  
 public static function setColumnWidth(array $arr)
 {
  $str = "";
  
  foreach ($arr as $v)
  {
   // ss:Index="7"
   $str .= "<Column ss:Width=\"$v\"/>\n";
  }
  self::write($str);
 }
 /**
  * 增加XML头部
  * Enter description here ...
  */
 public static function addHead()
 {
  //excel里面 style ID=64 就和CSS里面是一样的规则<cell ss:StyleID="s64">
   $str = self::$header . "\n <Styles>
  <Style ss:ID=\"s64\">
   <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
   <Font ss:FontName=\"微软雅黑\" x:CharSet=\"134\" ss:Size=\"9\" ss:Color=\"#404040\"/>
   <Interior ss:Color=\"#EFEFEF\" ss:Pattern=\"Solid\"/>
   <Borders>
    <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
     ss:Color=\"#D8D8D8\"/>
    <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
     ss:Color=\"#D8D8D8\"/>
    <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
     ss:Color=\"#D8D8D8\"/>
    <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
     ss:Color=\"#D8D8D8\"/>
   </Borders>
  </Style>
   <Style ss:ID=\"s65\">
     <Alignment ss:Horizontal=\"Center\" ss:Vertical=\"Center\"/>
    <Font ss:FontName=\"微软雅黑\" x:CharSet=\"134\" ss:Size=\"9\" ss:Color=\"#0070C0\"/>
    <Interior ss:Color=\"#FEFEFE\" ss:Pattern=\"Solid\"/>
    <Borders>
     <Border ss:Position=\"Bottom\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
      ss:Color=\"#D8D8D8\"/>
     <Border ss:Position=\"Left\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
      ss:Color=\"#D8D8D8\"/>
     <Border ss:Position=\"Right\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
      ss:Color=\"#D8D8D8\"/>
     <Border ss:Position=\"Top\" ss:LineStyle=\"Continuous\" ss:Weight=\"3\"
      ss:Color=\"#D8D8D8\"/>
    </Borders>
   </Style>
 </Styles>\n<Worksheet ss:Name=\"".self::$worksheet_title."\">\n<Table>\n
 
 
 ";
   
   self::write($str);
 }
 //添加一行数据 
 public function addArray ($array)
    {
 
        // run through the array and add them into rows
        foreach ((array)$array as $k => $v):
         if (!is_array($v)){
          continue;
         }
            self::addRow ($v);
        endforeach;
 
    }
    //尾部
    public static  function addFoot()
    {
     $str =  "</Table>\n</Worksheet>\n".self::$footer;
 
        self::write($str);
    }
    //增加工作表
    public static function addSheet($title)
    {
     self::$currentLine = 0;
     
     $str =  "</Table>\n</Worksheet>\n"."\n<Worksheet ss:Name=\"$title\">\n<Table>\n<Column ss:Index=\"1\" ss:AutoFitWidth=\"0\" ss:Width=\"110\"/>\n";
    
     self::write($str);
    }
    //写入文件
  private static function write($str)
  {
   file_put_contents(self::$filePath, $str."\n" , FILE_APPEND );
  }
  
  
}
