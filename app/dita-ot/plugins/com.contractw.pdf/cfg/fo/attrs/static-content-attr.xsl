<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:opentopic-i18n="http://www.idiominc.com/opentopic/i18n"
    xmlns:opentopic-index="http://www.idiominc.com/opentopic/index"
    xmlns:opentopic="http://www.idiominc.com/opentopic"
    xmlns:opentopic-func="http://www.idiominc.com/opentopic/exsl/function"
    xmlns:ot-placeholder="http://suite-sol.com/namespaces/ot-placeholder"
    xmlns:dita-ot="http://dita-ot.sourceforge.net/ns/201007/dita-ot"
    exclude-result-prefixes="opentopic-index opentopic opentopic-i18n opentopic-func dita-ot xs ot-placeholder"
    version="2.0">

  <!--Header Logo
  <xsl:attribute-set name="__header__image">
    <xsl:attribute name="padding-right">10pt</xsl:attribute>
  </xsl:attribute-set>-->
 
 <!--Header Leader
  <xsl:attribute-set name="__hdrftr__leader">
    <xsl:attribute name="leader-pattern">space</xsl:attribute>
  </xsl:attribute-set>-->

<!-- First Body Header (BookTitle) 
<xsl:variable name="map" select="//opentopic:map" as="element()?"/>
<xsl:variable name="bc.bookTitle">
    <xsl:value-of>
        <xsl:apply-templates select="$map/topicmeta" mode="dita-ot:text-only"/>
    </xsl:value-of>
</xsl:variable>-->

<!--Header-->
  <xsl:attribute-set name="odd__header">
    <!--<xsl:attribute name="text-align">right</xsl:attribute>
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
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, IPAMincho, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">white</xsl:attribute>
    <xsl:attribute name="border-bottom">1pt solid white</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="even__header">
    <!--<xsl:attribute name="text-align">left</xsl:attribute>
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
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, IPAMincho, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#000000</xsl:attribute>
    <xsl:attribute name="border-bottom">1pt solid blue</xsl:attribute>-->
  </xsl:attribute-set>
  
  <xsl:attribute-set name="__body__last__header" use-attribute-sets="even__header">
  </xsl:attribute-set>

  <xsl:attribute-set name="__body__last__footer" use-attribute-sets="even__footer">
  </xsl:attribute-set>

  <!-- Body Firstpage Header -->  
  <xsl:attribute-set name="__body__first__header">
    <xsl:attribute name="margin-top">15mm</xsl:attribute>
    <xsl:attribute name="margin-left">8mm</xsl:attribute>
    <xsl:attribute name="margin-right">8mm</xsl:attribute>    
    <!--<xsl:attribute name="end-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-before">10pt</xsl:attribute>
    <xsl:attribute name="space-before.conditionality">retain</xsl:attribute>-->
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, IPAMincho, Arial Unicode MS, Helvetica</xsl:attribute>

  </xsl:attribute-set>

  <xsl:attribute-set name="__body__first__header__booktitle">
    <xsl:attribute name="text-align">center</xsl:attribute>
    <xsl:attribute name="font-size">20pt</xsl:attribute>
    <xsl:attribute name="font-weight">bold</xsl:attribute>
    <xsl:attribute name="color">black</xsl:attribute>
    <xsl:attribute name="line-height">200%</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="__body__first__header__shortdesc">
    <xsl:attribute name="text-align">center</xsl:attribute>
    <xsl:attribute name="font-size">11pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">black</xsl:attribute>
    <xsl:attribute name="line-height">140%</xsl:attribute>
  </xsl:attribute-set>

  <!--Preface Header-->
  <xsl:attribute-set name="odd__header__preface">
    <!--<xsl:attribute name="border-bottom">1pt solid red</xsl:attribute>-->
  </xsl:attribute-set>
  
  <xsl:attribute-set name="even__header__preface">
    <!--<xsl:attribute name="border-bottom">1pt solid red</xsl:attribute>-->
  </xsl:attribute-set>

  <!--Footer-->
  <xsl:attribute-set name="odd__footer">
    <!--<xsl:attribute name="text-align">right</xsl:attribute>
    <xsl:attribute name="text-align-last">justify</xsl:attribute>
    <xsl:attribute name="end-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-after">10pt</xsl:attribute>
    <xsl:attribute name="space-after.conditionality">retain</xsl:attribute>
    <xsl:attribute name="padding-top">10mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">8mm</xsl:attribute>
    <xsl:attribute name="margin-top">1mm</xsl:attribute>
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, IPAMincho, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#000000</xsl:attribute>
    <xsl:attribute name="border-top">1pt solid black</xsl:attribute>-->
  </xsl:attribute-set>

  <xsl:attribute-set name="even__footer">
    <!--<xsl:attribute name="text-align">left</xsl:attribute>
    <xsl:attribute name="text-align-last">justify</xsl:attribute>
    <xsl:attribute name="start-indent">10pt</xsl:attribute>
    <xsl:attribute name="space-after">10pt</xsl:attribute>
    <xsl:attribute name="space-after.conditionality">retain</xsl:attribute>
    <xsl:attribute name="padding-top">10mm</xsl:attribute>
    <xsl:attribute name="padding-bottom">8mm</xsl:attribute>
    <xsl:attribute name="margin-top">1mm</xsl:attribute>
    <xsl:attribute name="margin-left">
      <xsl:value-of select="$page-margin-inside"/>
    </xsl:attribute>
    <xsl:attribute name="margin-right">
      <xsl:value-of select="$page-margin-outside"/>
    </xsl:attribute>
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, IPAMincho, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">9pt</xsl:attribute>
    <xsl:attribute name="font-weight">regular</xsl:attribute>
    <xsl:attribute name="color">#000000</xsl:attribute>
    <xsl:attribute name="border-top">1pt solid black</xsl:attribute>-->
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
        <!--<xsl:attribute name="font-size">20pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="border-before-width">0pt</xsl:attribute>
        <xsl:attribute name="border-after-width">0pt</xsl:attribute>
        <xsl:attribute name="padding-top">5pt</xsl:attribute>-->
    </xsl:attribute-set>

    <xsl:attribute-set name="__chapter__frontmatter__number__container">
        <!--<xsl:attribute name="font-size">20pt</xsl:attribute>
        <xsl:attribute name="font-weight">bold</xsl:attribute>
        <xsl:attribute name="color">red</xsl:attribute>-->
    </xsl:attribute-set>

</xsl:stylesheet>