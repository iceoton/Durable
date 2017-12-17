<?php
header("Content-Type: application/vnd.ms-excel");
header('Content-Disposition: attachment; filename="MyXls.xls"');#ชื่อไฟล์
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">
<HTML>
<HEAD>
    <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
</HEAD><BODY>
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
    <tr>
        <td width="1%">ลำดับที่</td>
        <td width="6%">รหัสครุภัณฑ์</td>
        <td width="14%">ชื่อครุภัณฑ์</td>
        <td width="29%">รายละเอียด</td>
        <td width="5%">วันที่ได้มาครั้งแรก</td>
        <td width="10%">สถานที่ตั้ง</td>
        <td width="5%">สถานะ</td>
        <td width="5%">ปริมาณ</td>
        <td width="5%">หน่วยนับ</td>
        <td width="10%">ผลการตรวจนับ</td>
        <td width="10%">หมายเหตุ</td>
    </tr>
    <TR>
        <TD>เครื่องพิมพ์ดีด</TD>
        <TD>แบบธรรมดาภาษาไทย ขนาดแคร่ยาวไม่ต่ำกว่า เครื่องพิมพ์ดีด ยี่ห้อ มอแกน รุ่น 40</TD>
        <TD>31/8/2537</TD>
    </TR>
</TABLE>
</BODY>
</HTML>