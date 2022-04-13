<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:rx="http://www.renderx.com/XSL/Extensions"
    xmlns:e="http://www.renderx.com/XSL/Extensions"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    version="2.0">

   <!-- titles -->
  <xsl:attribute-set name="common.title">
    <xsl:attribute name="font-family">,GenYoMin JP TTF Bold, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>

   <!-- BodyText -->
  <xsl:attribute-set name="__fo__root" use-attribute-sets="base-font">
      <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
      <!-- TODO: https://issues.apache.org/jira/browse/FOP-2409 -->
      <xsl:attribute name="xml:lang" select="translate($locale, '_', '-')"/>
      <xsl:attribute name="writing-mode" select="$writing-mode"/>
  </xsl:attribute-set>

    <!-- paragraph-like blocks -->
  <xsl:attribute-set name="common.block">
    <xsl:attribute name="space-before">0.6em</xsl:attribute>
    <xsl:attribute name="space-after">0.6em</xsl:attribute>
      <xsl:attribute name="line-height">
        <xsl:value-of select="$default-line-height"/>
      </xsl:attribute>    
  </xsl:attribute-set>

  <!--Page count-->
    <xsl:attribute-set name="__force__page__count">
        <xsl:attribute name="force-page-count">
            <xsl:choose>
                <xsl:when test="/*[contains(@class, ' bookmap/bookmap ')]">
                    <xsl:value-of select="'even'"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="'even'"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:attribute>
    </xsl:attribute-set>

<!--topic title border-->
  <xsl:attribute-set name="common.border__bottom">
    <xsl:attribute name="border-after-style">solid</xsl:attribute>
    <xsl:attribute name="border-after-width">1pt</xsl:attribute>
    <xsl:attribute name="border-after-color">black</xsl:attribute>
  </xsl:attribute-set>    
 
<!--Toc page number format-->
   <xsl:attribute-set name="page-sequence.frontmatter">
    <xsl:attribute name="format">1</xsl:attribute>
  </xsl:attribute-set>

<!--Topic numbering-->
  <xsl:variable as="xs:string" name="e:root-id" select="'root'" />

  <xsl:attribute-set name="__force__page__count">
        <xsl:attribute name="force-page-count">
            <xsl:choose>
                <xsl:when test="/*[contains(@class, ' bookmap/bookmap ')]">
                    <xsl:value-of select="'no-force'"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="'no-force'"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:attribute>
    </xsl:attribute-set>

  <xsl:attribute-set name="__fo__root">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="color">black</xsl:attribute>
    <xsl:attribute name="text-align">start</xsl:attribute>
    <xsl:attribute name="id" select="$e:root-id" />
  </xsl:attribute-set>
  
  <xsl:attribute-set name="chapter.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">20pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">12pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.topic.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
     <xsl:attribute name="font-size">11pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.topic.topic.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="topic.topic.topic.topic.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="section.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="example.title">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="common.link">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="tm">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="common.block">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="example">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="note__table">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="pre">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="fig">
    <xsl:attribute name="font-family">GenYoMin JP TTF Regular, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>

  <!--table bottom border-->
  <xsl:attribute-set name="table.border">
    <xsl:attribute name="border-after-style">solid</xsl:attribute>
    <xsl:attribute name="border-after-width">1pt</xsl:attribute>
    <xsl:attribute name="border-after-color">black</xsl:attribute>
  </xsl:attribute-set>  




</xsl:stylesheet>
