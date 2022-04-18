<?xml version='1.0'?>

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    xmlns:rx="http://www.renderx.com/XSL/Extensions"
    xmlns:e="http://www.renderx.com/XSL/Extensions"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    version="2.0">

   <!-- titles -->
  <xsl:attribute-set name="common.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P Bold, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>

   <!-- BodyText -->
  <xsl:attribute-set name="__fo__root" use-attribute-sets="base-font">
      <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
      <!-- TODO: https://issues.apache.org/jira/browse/FOP-2409 -->
      <xsl:attribute name="xml:lang" select="translate($locale, '_', '-')"/>
      <xsl:attribute name="writing-mode" select="$writing-mode"/>
  </xsl:attribute-set>

  <!--Page count
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
    </xsl:attribute-set>-->

<!--Title Lv1 Decoration-->
  <!--<xsl:attribute-set name="border__left__title">
    <xsl:attribute name="border-start-style">solid</xsl:attribute>
    <xsl:attribute name="border-start-width">4pt</xsl:attribute>
    <xsl:attribute name="border-start-color">blue</xsl:attribute>
  </xsl:attribute-set>-->

  <!--<xsl:attribute-set name="border__bottom__title">
    <xsl:attribute name="border-after-style">solid</xsl:attribute>
    <xsl:attribute name="border-after-width">1pt</xsl:attribute>
    <xsl:attribute name="border-after-color">black</xsl:attribute>
  </xsl:attribute-set>-->
  
 <!--Toc page number format-->
   <xsl:attribute-set name="page-sequence.frontmatter">
    <xsl:attribute name="format">1</xsl:attribute>
  </xsl:attribute-set>

<!--Topic numbering-->
 <xsl:variable as="xs:string" name="e:root-id" select="'root'" />
  <xsl:attribute-set name="__force__page__count">
    <xsl:attribute name="force-page-count">odd</xsl:attribute>
  </xsl:attribute-set>
  <xsl:attribute-set name="__fo__root">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="color">black</xsl:attribute>
    <xsl:attribute name="text-align">start</xsl:attribute>
    <xsl:attribute name="id" select="$e:root-id" />
  </xsl:attribute-set>
  
  <xsl:attribute-set name="chapter.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
    <xsl:attribute name="font-size">20pt</xsl:attribute>
    <xsl:attribute name="border-bottom">0pt solid black</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
     <xsl:attribute name="font-size">12pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.topic.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
     <xsl:attribute name="font-size">11pt</xsl:attribute>
  </xsl:attribute-set>

  <xsl:attribute-set name="topic.topic.topic.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="topic.topic.topic.topic.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="section.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="example.title">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="common.link">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="tm">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="common.block">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="example">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="note__table">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="pre">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>
  
  <xsl:attribute-set name="fig">
    <xsl:attribute name="font-family">Gen Shin Gothic P, IPAGothic, Arial Unicode MS, Helvetica</xsl:attribute>
  </xsl:attribute-set>

</xsl:stylesheet>
