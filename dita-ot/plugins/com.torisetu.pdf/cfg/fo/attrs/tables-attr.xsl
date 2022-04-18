<?xml version="1.0"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:fo="http://www.w3.org/1999/XSL/Format" version="2.0">

  <xsl:attribute-set name="common.table.head.entry">
    <xsl:attribute name="space-before">0pt</xsl:attribute>
    <!--<xsl:attribute name="space-before.conditionality">retain</xsl:attribute>-->
    <xsl:attribute name="space-after">0pt</xsl:attribute>
    <!--<xsl:attribute name="space-after.conditionality">retain</xsl:attribute>-->
    <xsl:attribute name="start-indent">0pt</xsl:attribute>
    <xsl:attribute name="end-indent">0pt</xsl:attribute>
    <xsl:attribute name="font-weight">Bold</xsl:attribute>
    <xsl:attribute name="color">white</xsl:attribute>
    <xsl:attribute name="background-color">blue</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="thead.row.entry__content" use-attribute-sets="common.table.head.entry">
    <!--head cell contents-->
 </xsl:attribute-set>

</xsl:stylesheet>