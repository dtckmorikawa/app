<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="2.0">

  <!--Header Logo-->
  <xsl:attribute-set name="__header__image">
    <xsl:attribute name="padding-right">10pt</xsl:attribute>
  </xsl:attribute-set>
 
 <!--Header Leader-->
  <xsl:attribute-set name="__hdrftr__leader">
    <xsl:attribute name="leader-pattern">space</xsl:attribute>
  </xsl:attribute-set>

<!--Header-->
  <xsl:attribute-set name="odd__header">
    <xsl:attribute name="text-align">right</xsl:attribute>
    <xsl:attribute name="end-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-before">10pt</xsl:attribute>
    <xsl:attribute name="space-before.conditionality">retain</xsl:attribute>
    <xsl:attribute name="margin-top">8mm</xsl:attribute>
    <xsl:attribute name="padding-top">3mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">3mm</xsl:attribute>
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#FFFFFF</xsl:attribute>
    <!--<xsl:attribute name="border-bottom">1pt solid black</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="even__header">
  <xsl:attribute name="text-align">left</xsl:attribute>
    <xsl:attribute name="start-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-before">10pt</xsl:attribute>
    <xsl:attribute name="space-before.conditionality">retain</xsl:attribute>
    <xsl:attribute name="padding-top">3mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">3mm</xsl:attribute>
    <xsl:attribute name="margin-top">8mm</xsl:attribute>
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#FFFFFF</xsl:attribute>
    <!--<xsl:attribute name="border-bottom">1pt solid black</xsl:attribute>-->
  </xsl:attribute-set>
  
    <xsl:attribute-set name="__body__last__header" use-attribute-sets="even__header">
    </xsl:attribute-set>

    <xsl:attribute-set name="__body__last__footer" use-attribute-sets="even__footer">
    </xsl:attribute-set>

<!--Preface Header-->
  <xsl:attribute-set name="odd__header__preface">
    <!--<xsl:attribute name="border-bottom">0pt solid red</xsl:attribute>-->
  </xsl:attribute-set>
  
  <xsl:attribute-set name="even__header__preface">
    <!--<xsl:attribute name="border-bottom">0pt solid red</xsl:attribute>-->
  </xsl:attribute-set>

<!--Footer-->
  <xsl:attribute-set name="odd__footer">
    <xsl:attribute name="text-align">right</xsl:attribute>
    <!--<xsl:attribute name="text-align-last">justify</xsl:attribute>-->
    <xsl:attribute name="end-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-after">10pt</xsl:attribute>
    <xsl:attribute name="space-after.conditionality">retain</xsl:attribute>
    <xsl:attribute name="padding-top">10mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">8mm</xsl:attribute>
    <!--<xsl:attribute name="margin-top">1mm</xsl:attribute>-->
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#FFFFFF</xsl:attribute>
    <!--<xsl:attribute name="border-top">1pt solid black</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="even__footer">
    <xsl:attribute name="text-align">left</xsl:attribute>
    <!--<xsl:attribute name="text-align-last">justify</xsl:attribute>-->
    <xsl:attribute name="start-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-after">10pt</xsl:attribute>
    <xsl:attribute name="space-after.conditionality">retain</xsl:attribute>
    <xsl:attribute name="padding-top">10mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">8mm</xsl:attribute>
    <!--<xsl:attribute name="margin-top">1mm</xsl:attribute>-->
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#FFFFFF</xsl:attribute>
     <!--<xsl:attribute name="border-top">1pt solid black</xsl:attribute>-->
  </xsl:attribute-set>
  
<!--Preface Footer-->
  <xsl:attribute-set name="odd__footer__preface">
    <!--<xsl:attribute name="border-top">0pt solid red</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="even__footer__preface">
     <!--<xsl:attribute name="border-top">0pt solid red</xsl:attribute>-->
  </xsl:attribute-set>

<!--Page Number-->
  <xsl:attribute-set name="pagenum">
    <xsl:attribute name="font-weight">bold</xsl:attribute>
    <xsl:attribute name="color">white</xsl:attribute>
  </xsl:attribute-set>


<!--Chapter Number as well as chapter border for top and bottom-->
    <xsl:attribute-set name="__chapter__frontmatter__name__container">
        <xsl:attribute name="font-size">20pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="padding-top">10pt</xsl:attribute>
        <xsl:attribute name="border-after-style">none</xsl:attribute>
        <xsl:attribute name="border-before-style">none</xsl:attribute>
    </xsl:attribute-set>    

    <xsl:attribute-set name="__chapter__frontmatter__number__container">
        <xsl:attribute name="font-size">20pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
    </xsl:attribute-set>

</xsl:stylesheet>